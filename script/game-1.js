console.log('game-1');
function startGame(el){
  console.log('начинаем игру');
  console.log('наш элемент:', el);
  console.log('родитель:', el.parentNode);
  imageEl.num = 1;
  el.style.display = 'none';
  el.parentNode.children[el.parentNode.num].classList.remove('d-none');
}
function showNextImage(el){
  console.log('Показать следующий');
  if(imageEl.num) { console.log('Текущий: ', imageEl.num); }
  else { console.log('Отсутствует: ', imageEl.num); }
  console.log(el);
}
let startEl = document.getElementById('start');
startEl.addEventListener('click', function(){startGame(this)}, false);
let imageEl = document.getElementById('image');
imageEl.addEventListener('click', function(){showNextImage(this)}, false);
