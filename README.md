# Ask AI Now 🤖✨

Ask AI Now is an interactive AI-powered FAQ assistant that leverages Google's **Gemini Model** for generating responses. It is built with **Laravel**, **FilamentPHP**, and **Livewire**, providing a seamless experience for users to ask questions and receive AI-driven answers.

## 🚀 Features

- 🤖 **AI-Powered Responses** - Uses Google's **Gemini Model** to generate intelligent answers.
- 💡 **Context-Aware Chat** - Remembers previous interactions to provide more relevant and intelligent responses.
- ⚡ **Real-Time Interaction** - Built with **Livewire** for dynamic, fast, and interactive communication.
- 🎧 **Conversation History** - Users can view past questions and answers for a better experience.
- 📚 **Admin Dashboard** - Powered by **FilamentPHP**, making it easy to manage AI responses and user queries.
- ⏳ **Live Loading Indicator** - Shows a thinking animation while processing responses.
- ⌨️ **Enter Key Submission** - Users can submit questions just by pressing **Enter**.

## 🛠️ Tech Stack

- **Backend:** Laravel, FilamentPHP, Livewire  
- **AI Model:** Google Gemini API  
- **Frontend:** Tailwind CSS, Alpine.js  
- **Database:** MySQL (or any supported Laravel DB)  

## 📦 Installation

1. Clone the repository:

   ```sh
   git clone https://github.com/zeeshantariq08/ask-ai-now.git
   cd ask-ai-now
   ```

2. Install dependencies:

   ```sh
   composer install
   npm install
   ```

3. Set up environment variables:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your **Google Gemini API Key** in `.env`:

   ```env
   GEMINI_API_KEY=your_api_key_here
   ```

5. Run migrations:

   ```sh
   php artisan migrate
   ```

6. Start the development server:

   ```sh
   php artisan serve
   ```

## 🔥 Usage

1. Visit `http://127.0.0.1:8000` in your browser.
2. Type a question in the input field and press **Enter**.
3. The AI will generate a response instantly!
4. Chat history is maintained for context-aware responses.
5. Admins can manage queries and logs via **FilamentPHP Dashboard**.

## 📸 Screenshots

> Add relevant screenshots here.

## 🛠️ Contributing

Feel free to contribute! Fork the repo, make changes, and open a **Pull Request**.

## 📝 License

This project is licensed under the **MIT License**.

---

### 🔗 Connect with me!
🚀 [GitHub](https://github.com/zeeshantariq08) | ✉️ [Email](mailto:zeeshiq58@gmail.com)
