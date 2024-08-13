// const axios = require('axios');

// const BOT_TOKEN = '7380108854:AAG-ROVgI872GE19rWLF8ht_LwWfHlkbytc'; // Thay thế bằng token bot của bạn
// const CHAT_ID = '1843647417'; // Thay thế bằng chat ID của bạn

// function sendTelegramNotification(message) {
//     const url = `https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`;
//     const params = {
//         chat_id: CHAT_ID,
//         text: message,
//     };

//     axios.post(url, params)
//         .then(response => {
//             console.log('Tin nhắn đã được gửi:', response.data);
//         })
//         .catch(error => {
//             console.error('Có lỗi xảy ra khi gửi tin nhắn:', error);
//         });
// }