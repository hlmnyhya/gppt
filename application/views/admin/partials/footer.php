

<script>
    // Function to handle emoji click for a specific form
    function handleEmojiClick(formId) {
        const form = document.getElementById(formId);
        const emojis = form.querySelectorAll('.emojis2 li');
        const ratingInput = form.querySelector('input[name="rate"]');

        emojis.forEach(emoji => {
            emoji.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;
            });
        });
    }
</script>