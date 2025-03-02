const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');
const historyList = document.getElementById('history-list');
const newChatBtn = document.getElementById('new-chat-btn');

let conversations = JSON.parse(localStorage.getItem('conversations')) || [];
let currentConversation = null;

// Function to render chat history
function renderHistory() {
  historyList.innerHTML = '';
  conversations.forEach((conv) => {
    const li = document.createElement('li');
    li.textContent = `Conversation ${conv.id}`;
    li.onclick = () => switchConversation(conv.id);

    // Delete Button
    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = '❌';
    deleteBtn.classList.add('delete-btn');
    deleteBtn.onclick = (e) => {
      e.stopPropagation();
      deleteConversation(conv.id);
    };

    li.appendChild(deleteBtn);
    historyList.appendChild(li);
  });
}

// Function to add a message
function addMessage(sender, message, isEditable = false) {
  const messageWrapper = document.createElement('div');
  messageWrapper.classList.add('message-wrapper');

  const messageElement = document.createElement('div');
  messageElement.classList.add('message', sender);
  messageElement.textContent = message;

  messageWrapper.appendChild(messageElement);

  if (isEditable) {
    const editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.classList.add('edit-btn');
    editButton.onclick = () => toggleEditMode(messageWrapper, messageElement, editButton);
    messageWrapper.appendChild(editButton);
  }

  chatBox.appendChild(messageWrapper);
  chatBox.scrollTop = chatBox.scrollHeight;
}

// Function to send a message
async function sendMessage(userMessage) {
  if (!userMessage) return;

  addMessage('user', userMessage, true);
  userInput.value = '';

  try {
    const response = await fetch('http://localhost:11434/api/generate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ model: 'phi', prompt: userMessage, stream: false }),
    });

    const data = await response.json();
    const botMessage = data.response;
    addMessage('bot', botMessage);

    if (currentConversation) {
      currentConversation.messages.push({ sender: 'user', text: userMessage });
      currentConversation.messages.push({ sender: 'bot', text: botMessage });
      saveCurrentConversation();
    }
  } catch (error) {
    console.error('Error:', error);
    addMessage('bot', 'Sorry, something went wrong. Please try again.');
  }
}

// Function to start a new conversation
function startNewConversation() {
  saveCurrentConversation();
  currentConversation = { id: Date.now(), messages: [] };
  conversations.push(currentConversation);
  localStorage.setItem('conversations', JSON.stringify(conversations));
  chatBox.innerHTML = ''; // Clear chat box for new conversation
  renderHistory();
}

// Function to switch between conversations
function switchConversation(conversationId) {
  saveCurrentConversation();
  
  const selectedConversation = conversations.find((conv) => conv.id === conversationId);
  if (!selectedConversation) return;

  currentConversation = selectedConversation;
  chatBox.innerHTML = ''; // ✅ Clear chat before loading new conversation

  selectedConversation.messages.forEach(({ sender, text }) => {
    addMessage(sender, text, sender === 'user');
  });
}

// Function to save the current conversation before switching
function saveCurrentConversation() {
  if (!currentConversation) return;
  const index = conversations.findIndex((conv) => conv.id === currentConversation.id);
  if (index !== -1) {
    conversations[index] = currentConversation;
  } else {
    conversations.push(currentConversation);
  }
  localStorage.setItem('conversations', JSON.stringify(conversations));
  renderHistory();
}

// Function to delete a conversation
function deleteConversation(conversationId) {
  conversations = conversations.filter((conv) => conv.id !== conversationId);
  localStorage.setItem('conversations', JSON.stringify(conversations));
  renderHistory();
}

// Load the last conversation if available
function loadLastConversation() {
  if (conversations.length > 0) {
    switchConversation(conversations[conversations.length - 1].id);
  }
}

// Event Listeners
sendBtn.addEventListener('click', () => sendMessage(userInput.value.trim()));
userInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') sendMessage(userInput.value.trim());
});
newChatBtn.addEventListener('click', startNewConversation);

// Initial Load
renderHistory();
loadLastConversation();
