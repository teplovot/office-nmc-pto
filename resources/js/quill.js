// Ініціалізація текстового редактора Quill
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    const editorElement = document.getElementById('editor');
    if (editorElement) {
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Введіть опис завдання...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered'}, { list: 'bullet' }],
                    ['link', 'image'],
                    [{ color: [] }],
                    ['clean']
                ]
            }
        });

        // Перед відправкою форми копіюємо HTML у hidden input
        const form = editorElement.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                const input = document.getElementById('description');
                if (input) {
                    input.value = quill.root.innerHTML;
                }
            });
        }
    }
});
