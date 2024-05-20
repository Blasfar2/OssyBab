

const isAdmin = True; // Replace with your logic to determine admin status
const AdminName = "Badr"



const userInfoDiv = document.getElementById('user-info');
const userImage = document.getElementById('user-image');
const userName = document.getElementById('user-name');
const signInBtn = document.getElementsByClassName('sign-in-btn');

function updateContent() {
  if (isAdmin) {
    userInfoDiv.style.display = 'block';
    userImage.src = './img/profile1.jpg'; // Replace with admin image
    userName.textContent = AdminName;
    signInBtn.style.display = 'none';
    StyleUSerImage = userImage.style ;

    StyleUSerImage.width="30px";
    StyleUSerImage.height="30px";
    userImage.style.borderRadius="50%"

    userName.style.color = "white";



  } else {
    userInfoDiv.style.display = 'none';
    userImage.src = ''; // Clear image source
    userName.textContent = ''; // Clear name
    signInBtn.style.display = 'block';

  }
}

updateContent();

