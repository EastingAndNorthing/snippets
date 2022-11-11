Lockr.toggle = function(key, value, options) {
  var query_key = this._getPrefixedKey(key, options), json;
  var values = Lockr.smembers(key);
  
  var toggledState = false;
  
  try {
    if(values.indexOf(value) === -1) {
        values.push(value);
        toggledState = true;
    } else {
        values.splice(values.indexOf(value), 1);
        toggledState = false;
    }
    if(values.length < 1) values = void(0);
    json = JSON.stringify({"data": values});
    localStorage.setItem(query_key, json);
  } catch (e) {
    console.log(e);
  }
  
  return toggledState;
}