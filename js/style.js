let menubar = document.querySelector("#menubar");
let nav = document.querySelector(".navbar");

menubar.onclick = () =>{
    menubar.classList.toggle('fa-times')
    nav.classList.toggle('active')
};


//modal

 const modal = document.querySelector('.modal-container')

 function openModal(){
  modal.classList.add('active')
 }

 function closeModal() {
  modal.classList.remove('active')
 }