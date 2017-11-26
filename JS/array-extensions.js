Array.prototype.pushUnique = function(value) {
  
  if(this.indexOf(value) === -1)
    this.push(value);
  
  return this;
}

Array.prototype.toggle = function(value) {
  
  if(this.indexOf(value) === -1) {
    this.push(value);
  } else {
    this.splice(this.indexOf(value), 1);
  }
  
  return this;
}