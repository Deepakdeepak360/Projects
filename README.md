# Chat with AI

A simple web-based AI chatbot that allows users to have conversations with an AI model. It includes conversation history, local storage support, and a clean UI.

## Features

- **Real-time AI Chat**: Send messages and receive AI-generated responses.
- **Conversation History**: Past chats are saved and can be revisited.
- **Local Storage Support**: Conversations are stored in `localStorage` for persistence.
- **New Chat Feature**: Start a fresh conversation anytime.
- **Editable Messages**: Users can edit their own messages.
- **Delete Conversations**: Remove past conversations from history.
- **Responsive UI**: Works on both desktop and mobile devices.

## Installation & Setup

1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/chat-with-ai.git
   cd chat-with-ai
   ```
2. Open `index.html` in a browser to start using the chatbot.

## Usage

- Type a message in the input box and click "Send".
- The AI will generate a response and display it in the chat window.
- Click the "➕" button to start a new conversation.
- Click on a conversation in the sidebar to load past chats.
- Click "❌" to delete a conversation from history.

## API Integration

The chatbot interacts with an AI model hosted at `http://localhost:11434/api/generate`.

- **Request Format** (POST):
  ```json
  {
    "model": "phi",
    "prompt": "Your message here",
    "stream": false
  }
  ```
- **Response Format:**
  ```json
  {
    "response": "AI-generated reply"
  }
  ```

## Screenshots

![Chat with AI Screenshot](Screenshot%202025-03-02%20101703.png)

## Technologies Used

- HTML, CSS (Frontend UI)
- JavaScript (Client-side logic & API calls)
- LocalStorage (Data persistence)

## License

This project is open-source and available under the MIT License.

## Contribution

Feel free to fork the repository and submit pull requests with improvements!

