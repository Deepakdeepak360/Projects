const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');

// Function to add a message to the chat box
function addMessage(sender, message) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message', sender);
  messageElement.textContent = message;
  chatBox.appendChild(messageElement);
  chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the latest message
}

// Function to send user input to the Ollama API (Phi-2 model)
async function sendMessage() {
  const userMessage = userInput.value.trim();
  if (!userMessage) return;

  addMessage('user', userMessage);
  userInput.value = '';

  try {
    const response = await fetch('http://localhost:11434/api/generate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        model: 'phi', // Use the Phi-2 model
        prompt: userMessage, // User's input as the prompt
        stream: false, // Set to true if you want streaming responses
      }),
    });

    const data = await response.json();
    const botMessage = data.response; // Extract the response from Ollama
    addMessage('bot', botMessage);
  } catch (error) {
    console.error('Error:', error);
    addMessage('bot', 'Sorry, something went wrong. Please try again.');
  }
}

// Event listeners
sendBtn.addEventListener('click', sendMessage);
userInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') sendMessage();
});