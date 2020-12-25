console.log('game-1');
let songTextEl = document.getElementById('text');
let songText = songTextEl.textContent;
// console.log(songText);
// let songTextByWords = songText.split(' ');
// console.log(songTextByWords);
function splitTextByWords(stext){
  let text = stext;
  let splittedText = text.split(' ');
  //console.log(splittedText);
  //console.log(splittedText.length);
  for (let i = 0; i < splittedText.length; i++) {
    if(splittedText[i]) {
      //console.log('true', splittedText[i]);
    } else {
      //console.log('false', splittedText[i]);
      splittedText.splice(i, 1);
      i--;
    }
  }
  // console.log(splittedText);
  for (let i = 0; i < splittedText.length; i++) {
    if(splittedText[i].includes("\n")){
      // console.log('сожердит', splittedText[i]);
      let chIndex = splittedText[i].indexOf('\n');
      // console.log('byltrc', chIndex);
      let clear = splittedText[i].substring(0, chIndex);
      // console.log('чистый', clear);
      if(clear) {
        splittedText[i] = clear;
      } else {
        splittedText.splice(i, 1);
        i--;
      }
    } else {
      // console.log('НЕ сожердит', splittedText[i]);
    }
    // console.log(splittedText[i]);
  }
  //console.log(splittedText);
  return splittedText;
}
let newSongText = splitTextByWords(songText);
console.log(newSongText);
// получаем изображение по слову
const fetchPromise = fetch(
  'http://disgo.ru/game-1-ajax.php',
  {
      method: 'GET'
  }
);
console.log('fetchPromise', fetchPromise);

const getRawDataPromise = fetchPromise.then(res => console.log('res', res));
console.log('getRawDataPromise', getRawDataPromise);

// const dataPromise = getRawDataPromise.then(res => console.log('res', res));
// console.log('dataPromise', dataPromise);
