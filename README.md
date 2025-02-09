# 🤖 Ask AI Now

**Ask AI Now** is an AI-powered FAQ assistant built with **Laravel Livewire** and **Filament**. It allows users to ask questions and receive instant AI-generated responses.

## 🚀 Features

- 🧠 AI-powered responses to user questions
- ⚡ Built using Laravel Livewire & Filament
- ⌨️ Submit questions by pressing **Enter**
- 🎨 Interactive and responsive UI
- 🔄 Loading animation for better UX

## 🛠️ Installation

Follow these steps to set up the project locally:

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/your-username/ask-ai-now.git
cd ask-ai-now
```

### 2️⃣ Install Dependencies
```sh
composer install
npm install && npm run dev
```

### 3️⃣ Set Up Environment Variables
```sh
cp .env.example .env
php artisan key:generate
```
Update the `.env` file with your **database** and **AI API** credentials.

### 4️⃣ Run Migrations
```sh
php artisan migrate
```

### 5️⃣ Start the Development Server
```sh
php artisan serve
```

## 🎯 Usage
- Open the app in a browser.
- Type a question and press **Enter** to get an AI-generated response.
- Responses are displayed dynamically using **Livewire**.

## 🔧 Contributing
Feel free to fork the repo and submit a **pull request** if you'd like to contribute!

## 📄 License
This project is licensed under the **MIT License**.

---
Made with ❤️ using Laravel & Filament.
