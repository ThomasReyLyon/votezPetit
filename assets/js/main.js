// MODAL

let btnmodal = document.getElementById('btnmodal');
let modal = document.getElementById('modal')
let closeModal = document.getElementById('closeModal')
let cancel = document.getElementById('cancel')

btnmodal.addEventListener('click', function(){
    modal.classList.add('is-active');
})
closeModal.addEventListener('click', function(){
    modal.classList.remove('is-active')
})
cancel.addEventListener('click', function(){
    modal.classList.remove('is-active')
})

document.addEventListener('DOMContentLoaded', () => {
    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
        $notification = $delete.parentNode;
        $delete.addEventListener('click', () => {
            $notification.parentNode.removeChild($notification);
        });
    });
});