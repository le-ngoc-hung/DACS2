const contentBox = document.getElementById('contentBox');
const showMoreBtn = document.getElementById('showMoreBtn');

if (contentBox.scrollHeight > contentBox.clientHeight) {
    contentBox.classList.add('overflowing');
}

showMoreBtn.addEventListener('click', () => {
    contentBox.classList.toggle('expandable');

    showMoreBtn.textContent = contentBox.classList.contains('expandable') ? 'Hiện thêm' : 'Ẩn bớt';

    if (contentBox.classList.contains('expandable')) {
        contentBox.style.maskImage = '';
        contentBox.style.webkitMaskImage = '';
    } else {
        contentBox.style.maskImage = 'none'; 
        contentBox.style.webkitMaskImage = 'none';
    }
});
