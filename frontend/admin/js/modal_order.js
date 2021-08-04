const btnClose = document.querySelector('#close');
const buttonOpen = document.querySelector('#open_details');

let isModalOpen = false;

function handleModal() {
  if (!isModalOpen) {
    document.querySelector('#modal').style.visibility = 'visible';
    isModalOpen = true;
    return;
  }

  document.querySelector('#modal').style.visibility = 'hidden';
  isModalOpen = false;
}
