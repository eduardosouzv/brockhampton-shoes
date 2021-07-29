const modal = document.getElementById('overlay');
const body = document.getElementsByTagName('body');
const container = document.getElementsByClassName('page_container');
const btnClose = document.getElementById('close');
const btnOpen = document.getElementById('look');

btnOpen.onclick = function () {
  modal.className = 'modal visuallyHidden';
  setTimeout(function () {
    container.className = 'container blurred';
    modal.className = 'modal';
  }, 100);
  container.className = 'modalOpen';
};

btnClose.onclick = function () {
  modal.className = 'modal hidden visuallyHidden';
  container.className = 'container';
};
