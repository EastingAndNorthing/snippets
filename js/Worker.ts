// Main.ts
import workerPath from "./worker?url";

const worker = new Worker(
    new URL(workerPath, import.meta.url),
    { type: 'module' }
);

console.log(workerPath, worker);

worker.addEventListener('message', message => {
    console.log(message);
});
worker.postMessage('this is a test message to the worker');





// Worker.ts
console.log('hello from a webworker');

addEventListener('message', (message) => {
    console.log('in webworker', message);
    postMessage('this is the response ' + message.data);
});

