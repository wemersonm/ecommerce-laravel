export function useCounter() {
  const counter = 1;
  function increment(max) {
    if (this.counter < max) this.counter++;
  }
  function decrement(min = 1) {
    console.log('min: ' + min, 'counter: ', counter);
    if (this.counter > min) this.counter--;
  }

  return {
    counter,
    increment,
    decrement,
  };
}
