console.log('game-1');
function startGame(){
  imageEl.num = 1;
  imageEl.lastImgNum = imageEl.childNodes.length - 1;
  imageEl.children[0].style.display = 'none';
  imageEl.children[imageEl.num].classList.remove('d-none');
  if(imageEl.showWords){
    imageEl.children[imageEl.num].children[1].classList.remove('d-none');
  }
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
    if(imageEl.showWords) {
      imageEl.children[imageEl.num].children[1].classList.add('d-none');
    }
    imageEl.num++;
    imageEl.children[imageEl.num].classList.remove('d-none');
    if(imageEl.showWords){
      imageEl.children[imageEl.num].children[1].classList.remove('d-none');
    }
  }
  else {
    // console.log('Элементы закончились - показываем меню');
    imageEl.children[imageEl.num].classList.add('d-none');
    if(imageEl.showWords){
      imageEl.children[imageEl.num].children[1].classList.add('d-none');
    }
    showGameMenu();
  }
}
function refreshImage(){
  console.log('Меняем изображение');
}
function showGameMenu(){
  // console.log('Показываем меню игры');
  imageEl.classList.remove('d-flex');
  imageEl.classList.add('d-none');
  imageEl.previousElementSibling.previousElementSibling.style.display = 'none';
  gameMenuEl.classList.remove('d-none');
  gameMenuEl.classList.add('d-flex');
}
function gameMenu(){
  if(event.target.id == 'option-1'){
    // console.log('Повторить');
    imageEl.showWords = false;
    imageEl.children[0].style.display = 'inline-block';
    imageEl.previousElementSibling.previousElementSibling.style.display = 'block';
    imageEl.classList.remove('d-none');
    imageEl.classList.add('d-flex');
    gameMenuEl.classList.remove('d-flex');
    gameMenuEl.classList.add('d-none');
  }
  if(event.target.id == 'option-2'){
    // console.log('Повторить со словами');
    imageEl.showWords = true;
    imageEl.children[0].style.display = 'inline-block';
    imageEl.previousElementSibling.previousElementSibling.style.display = 'block';
    imageEl.classList.remove('d-none');
    imageEl.classList.add('d-flex');
    gameMenuEl.classList.remove('d-flex');
    gameMenuEl.classList.add('d-none');
  }
  if(event.target.id == 'option-3'){
    // console.log('Выбрать ответ');
    gameMenuEl.classList.remove('d-flex');
    gameMenuEl.classList.add('d-none');
    gameAnswersEl.classList.remove('d-none');
    gameAnswersEl.classList.add('d-flex');
  }
}
function checkAnswer(){
  // console.log('Сверяем выбранный ответ');
  gameAnswersEl.answer = false;
  if(event.target.classList.contains('answer')) {
    if(event.target.id == 'true'){
      // console.log('Позравляем, Вы угадали');
      gameAnswersEl.answer = true;
    } else {
      // console.log('К сожалению, Вы проиграли');
      gameAnswersEl.answer = false;
    }
    // console.log('Проставляем необходимые стили');
    for (let i = 0; i < gameAnswersEl.childNodes.length; i++) {
      if(gameAnswersEl.children[i].id == 'true'){
        gameAnswersEl.children[i].classList.add('true');
      } else {
        gameAnswersEl.children[i].classList.add('wrong');
      }
    }
    // console.log('выводим кнопку с новой игрой');
    let newGameEl = document.createElement('A');
    newGameEl.href = 'game-1.php';
    if(gameAnswersEl.answer) {
      newGameEl.innerHTML = 'Позравляем, Вы угадали!';
    } else {
      newGameEl.innerHTML = 'К сожалению, Вы проиграли.';
    }
    newGameEl.classList.add('new-game');
    gameAnswersEl.appendChild(newGameEl);
  }
}
let startEl = document.getElementById('start');
startEl.addEventListener('click', function(){startGame()}, false);
let imageEl = document.getElementById('image');
imageEl.showWords = false; // опция показа слов
imageEl.addEventListener('click', function(){showNextImage()}, false);
let gameMenuEl = document.getElementById('game-menu');
gameMenuEl.addEventListener('click', function(){gameMenu()}, false);
let gameAnswersEl = document.getElementById('game-answers');
gameAnswersEl.addEventListener('click', function(){checkAnswer()}, false);

/** Проверка доступа к Ya.ru  */
let test123 = fetch('https://www.googleapis.com/customsearch/v1?key=AIzaSyBHoBbZmuSzPjJwtUA8UL6yhgKy2HGaqtg&cx=cfaea5bf17c170da0&q=лесу').
then( (response) => {console.log(response); return response.text();}).
then( (response) => {console.log(response);} );
