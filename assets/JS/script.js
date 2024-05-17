

const isAdmin = false; // Replace with your logic to determine admin status

const userInfoDiv = document.getElementById('user-info');
const userImage = document.getElementById('user-image');
const userName = document.getElementById('user-name');
const signInBtn = document.getElementById('sign-in-btn');

function updateContent() {
  if (isAdmin) {
    userInfoDiv.style.display = 'block';
    userImage.src = 'admin-image.png'; // Replace with admin image
    userName.textContent = 'Admin User';
    signInBtn.style.display = 'none';
  } else {
    userInfoDiv.style.display = 'none';
    userImage.src = ''; // Clear image source
    userName.textContent = 'badr'; // Clear name
    signInBtn.style.display = 'block';
  }
}

updateContent();

