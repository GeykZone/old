import nltk
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.stem import WordNetLemmatizer
from sklearn.feature_extraction.text import TfidfVectorizer
from fuzzywuzzy import fuzz

nltk.download('punkt')
nltk.download('stopwords')
nltk.download('wordnet')

# Read QA pairs from a text file
def read_qa_pairs(file_path):
    qa_pairs = []
    with open(file_path, 'r') as file:
        for line in file:
            parts = line.strip().split('   ')
            if len(parts) == 2:
                question = parts[0]
                answer = parts[1]
                qa_pairs.append([question, answer])
            else:
                print("Invalid format in line:", line)
    return qa_pairs

# Write QA pairs to a text file
def write_qa_pairs(file_path, qa_pairs):
    with open(file_path, 'w') as file:
        for pair in qa_pairs:
            file.write(pair[0] + '   ' + pair[1] + '\n')

# Preprocess text by tokenizing, removing stopwords, and joining back
def preprocess_text(text):
    stop_words = set(stopwords.words('english'))
    lemmatizer = WordNetLemmatizer()
    tokens = word_tokenize(text.lower())
    tokens = [lemmatizer.lemmatize(token) for token in tokens if token.isalnum() and token not in stop_words]
    return ' '.join(tokens)

# Preprocess the training data
file_path = 'qa_pairs.txt'  # Update with the path to your text file
qa_pairs = read_qa_pairs(file_path)

# Preprocess the questions
preprocessed_qa_pairs = [[preprocess_text(pair[0]), pair[1]] for pair in qa_pairs]

# Initialize and fit the TF-IDF vectorizer
corpus = [pair[0] for pair in preprocessed_qa_pairs]
vectorizer = TfidfVectorizer()
vectorizer.fit(corpus)

# Function to get the most similar question index
def get_most_similar_question(query, questions):
    best_match_score = 0
    best_match_index = None

    for i, question in enumerate(questions):
        match_score = fuzz.partial_ratio(query, question)
        if match_score > best_match_score:
            best_match_score = match_score
            best_match_index = i

    return best_match_index

# Function to answer the user's question
def answer_question(user_query):
    preprocessed_query = preprocess_text(user_query)
    question_index = get_most_similar_question(preprocessed_query, [pair[0] for pair in preprocessed_qa_pairs])
    
    if question_index is None or fuzz.partial_ratio(preprocessed_query, preprocessed_qa_pairs[question_index][0]) < 80:
        # The question is not in the QA pairs or does not have a close match, so ask for the answer
        answer = input("AI: I don't know the answer. Can you please provide it? ")
        
        # Add the new question-answer pair to the QA pairs
        new_qa_pair = [preprocessed_query, answer]
        qa_pairs.append(new_qa_pair)
        
        # Update the preprocessed QA pairs and the TF-IDF vectorizer
        preprocessed_qa_pairs.append(new_qa_pair)
        corpus.append(preprocessed_query)
        vectorizer.fit(corpus)
        
        # Write the updated QA pairs back to the file
        write_qa_pairs(file_path, qa_pairs)
        
        return answer
    else:
        # Retrieve the answer from the QA pairs
        return qa_pairs[question_index][1]

# Chatbot interaction loop
while True:
    user_input = input("User: ")
    answer = answer_question(user_input)
    print("AI: " + answer)
