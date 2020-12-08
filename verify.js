function parseBalls(hash, count = 1) {
  let res = {};
  for (let c = 0; c < count; c++) {
    let balls = [], available = [];
    for (let i = 1; i <= 28; i++) {
      available.push(i);
    }
    for (let i = 0; i < 7; i++) {
      let num = parseInt("0x" + hash.substr(8 * i, 8));
      if (i === 5) {
        balls.push(num % 10);
      } else {
        let tt = num % available.length;
        balls.push(available.splice(tt, 1)[0]);
      }
    }
    res[hash] = balls;

    hash = Sha256.hash(hash);
  }
  return res;
}
