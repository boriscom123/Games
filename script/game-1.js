console.log('game-1');
function startGame(el){
  imageEl.num = 1;
  imageEl.lastImgNum = imageEl.childNodes.length - 1;
  el.style.display = 'none';
  imageEl.children[imageEl.num].classList.remove('d-none');
  if(event.target.tagName == 'I'){
    // console.log('Останавливаем всплытие на первом элементе I');
    event.stopPropagation();
  }
}
function showNextImage(el){
  if(event.target.classList.contains('change-img')){
    refreshImage();
    return;
  }
  if(event.target.classList.contains('fa-sync-alt')){
    refreshImage();
    return;
  }
  if(imageEl.num < imageEl.lastImgNum) {
    imageEl.children[imageEl.num].classList.add('d-none');
    imageEl.num++;
    imageEl.children[imageEl.num].classList.remove('d-none');
  }
  else {
    console.log('Элементы закончились - показываем меню');
  }
}
function refreshImage(){
  console.log('Меняем изображение');
}
let startEl = document.getElementById('start');
startEl.addEventListener('click', function(){startGame(this)}, false);
let imageEl = document.getElementById('image');
imageEl.addEventListener('click', function(){showNextImage(this)}, false);
