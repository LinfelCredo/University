const canvas = document.getElementById('signature-pad');
const ctx = canvas.getContext('2d');
let drawing = false;

canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mousemove', draw);

canvas.addEventListener('touchstart', startDrawing);
canvas.addEventListener('touchend', stopDrawing);
canvas.addEventListener('touchmove', draw);

document.getElementById('clear-btn').addEventListener('click', clearCanvas);
document.getElementById('save-btn').addEventListener('click', saveSignature);

function startDrawing(event) {
    drawing = true;
    ctx.beginPath();
    ctx.moveTo(getX(event), getY(event));
    event.preventDefault();
}

function stopDrawing(event) {
    drawing = false;
    ctx.closePath();
    event.preventDefault();
}

function draw(event) {
    if (!drawing) return;
    ctx.lineTo(getX(event), getY(event));
    ctx.stroke();
    event.preventDefault();
}

function getX(event) {
    if (event.type.includes('touch')) {
        return event.touches[0].clientX - canvas.getBoundingClientRect().left;
    } else {
        return event.clientX - canvas.getBoundingClientRect().left;
    }
}

function getY(event) {
    if (event.type.includes('touch')) {
        return event.touches[0].clientY - canvas.getBoundingClientRect().top;
    } else {
        return event.clientY - canvas.getBoundingClientRect().top;
    }
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

