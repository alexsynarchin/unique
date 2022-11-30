export  function numWords(value, words) {
    value = Math.abs(value) % 100;
    var num = value % 10;
    if(value > 10 && value < 20) return words[2];
    if(num > 1 && num < 5) return words[1];
    if(num == 1) return words[0];
    return words[2];
}

export function OneOrManyWord(words, value) {
    value = Math.abs(value);
    if( value === 1) {
        return words[0];
    } else  {
        return words[1];
    }
}

