const uniqueId = function() {
  return String(Math.random().toString(36).substr(2, 16));
};