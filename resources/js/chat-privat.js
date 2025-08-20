document.getElementById("send").addEventListener("click", function () {
    fetch("/chat-private", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": crfToken,
        },
        body: JSON.stringify({
            to: document.getElementById("recipient").value,
            message: document.getElementById("message").value,
        }),
    });
    document.getElementById("message").value = "";
});

const recipientSelect = document.getElementById("recipient");
const audio = document.getElementById("notify-sound");
let currentChannel = null;

function subscribeToChannel() {
    if (currentChannel) {
        window.Echo.leave(currentChannel);
    }

    let users = [authId, recipientSelect.value].sort();
    const channelName = `chat.${users[0]}.${users[1]}`;
    currentChannel = `private-${channelName}`;

    if (!window.chatSubscribed) {
        window.chatSubscribed = true;

        window.Echo.private(`private-messages.${authId}`).listen(
            "PrivatChat",
            (e) => {
                const li = document.createElement("li");
                li.textContent = `${e.fromLastName}: ${e.message}`;
                document.getElementById("chat-box").appendChild(li);

                audio.play().catch((err) => console.log("Помилка звуку:", err));

                // Змінюємо через Alpine
    Alpine.$data(document.getElementById("chat-container")).open = true;


            }
        );
    }
}

// Підписка на канал
subscribeToChannel();
recipientSelect.addEventListener("change", subscribeToChannel);
