<?php include "session_check.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaxBot AI - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            font-size: 14px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            overflow: hidden;
            z-index: 1000;
        }
        #chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 12px 16px;
            cursor: pointer;
        }
        #chat-toggle {
            float: right;
            font-size: 18px;
            cursor: pointer;
        }
        #chat-box {
            display: none;
            background-color: #fff;
            max-height: 400px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        #chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background: #f9f9f9;
        }
        .message {
            margin-bottom: 10px;
        }
        .user {
            text-align: right;
            color: #007bff;
        }
        .gemini {
            text-align: left;
            color: #333;
        }
        .chat-input-area {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }
        #userInput {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 8px;
        }
        button {
            padding: 8px 12px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
        :root {
            --primary: #FF6B35;
            --secondary: #2D3142;
            --accent: #4CAF50;
            --lightbg: #F7F9FC;
            --cardbg: rgba(255, 255, 255, 0.95);
            --gradient: linear-gradient(135deg, #FF6B35, #FF8C66);
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --neumo-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.9);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--lightbg);
            margin: 0;
        }
        .navbar {
            background: var(--gradient);
            padding: 1rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
        }
        .user-dropdown {
            position: relative;
        }
        .user-icon {
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .user-dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content span,
        .dropdown-content button {
            padding: 0.8rem 1rem;
            background: none;
            border: none;
            color: var(--secondary);
            text-align: left;
            cursor: pointer;
        }
        .container {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        h1 {
            font-size: 2.2rem;
            color: var(--secondary);
            font-weight: 600;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }
        .card {
            background: var(--cardbg);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--neumo-shadow);
        }
        .card h2 {
            font-size: 1.5rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }
        .chart-container {
            height: 300px;
        }
        .btn {
            margin-top: 1rem;
            padding: 0.8rem;
            border: none;
            background: var(--gradient);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 320px;
            font-family: 'Poppins', sans-serif;
            z-index: 1001;
        }
        #chat-header {
            background: var(--primary);
            color: white;
            padding: 0.7rem 1rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        #chat-box {
            display: none;
            background: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 10px 10px;
            box-shadow: var(--shadow);
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        #chat-messages {
            padding: 1rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        .chat-input-area {
            display: flex;
            border-top: 1px solid #ddd;
        }
        .chat-input-area input {
            flex: 1;
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            outline: none;
        }
        .chat-input-area button {
            background: var(--accent);
            color: white;
            border: none;
            padding: 0 1.2rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <span class="nav-logo">TaxBot AI</span>
        <div class="nav-links">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="taxy.php">Tax Planner</a>
            <a href="analysis.php">Analysis</a>
            <a href="forecasting.php">Forecasting</a>
        </div>
        <div class="user-dropdown">
            <i class="fas fa-user-circle user-icon"></i>
            <div class="dropdown-content">
                <span>Guest User</span>
                <button onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <h1><i class="fas fa-robot"></i> Your Tax Dashboard</h1>
    <div class="grid">
        <div class="card">
            <h2><i class="fas fa-shopping-cart"></i> Spending Habits</h2>
            <div class="chart-container">
                <canvas id="spendingChart"></canvas>
            </div>
        </div>
        <div class="card">
            <h2><i class="fas fa-lightbulb"></i> Tax Optimization</h2>
            <div class="chart-container">
                <canvas id="optimizationChart"></canvas>
            </div>
        </div>
        <div class="card">
            <h2><i class="fas fa-chart-pie"></i> Overall Summary</h2>
            <div class="chart-container">
                <canvas id="summaryChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div id="chatbot-container">
    <div id="chat-header">Gemini AI <span id="chat-toggle">&#x1F4AC;</span></div>
    <div id="chat-box">
        <div id="chat-messages"></div>
        <div class="chat-input-area">
            <input type="text" id="userInput" placeholder="Ask me anything..." onkeydown="handleKey(event)">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

<script>
    function logout() {
        window.location.href = 'taxbot-ai 1.html';
    }

    document.getElementById("chat-toggle").addEventListener("click", () => {
        const box = document.getElementById("chat-box");
        box.style.display = box.style.display === "none" || !box.style.display ? "flex" : "none";
    });

    function appendMessage(sender, text) {
        const msg = document.createElement("div");
        msg.innerHTML = `<strong>${sender}:</strong> ${text}`;
        msg.style.marginBottom = "0.8rem";
        document.getElementById("chat-messages").appendChild(msg);
        document.getElementById("chat-messages").scrollTop = document.getElementById("chat-messages").scrollHeight;
    }


    async function sendMessage() {
        const userInput = document.getElementById("userInput");
        const message = userInput.value.trim();
        if (!message) return;
        appendMessage("You", message);
        userInput.value = "";

        try {
            const response = await fetch("gemini.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ message })
            });
            const data = await response.json();

            const text =
                data.candidates?.[0]?.content?.parts?.[0]?.text ||
                data.candidates?.[0]?.content?.parts?.[0] ||
                data.candidates?.[0]?.output ||
                "⚠️ Gemini gave no usable response.";

            appendMessage("TaxBot AI", text);
        } catch (err) {
            appendMessage("Gemini", `⚠️ Failed to connect: ${err.message}`);
        }
    }


    const spendingCtx = document.getElementById("spendingChart").getContext("2d");
    new Chart(spendingCtx, {
        type: "bar",
        data: {
            labels: ["Housing", "Food", "Transport", "Entertainment", "Others"],
            datasets: [{
                label: "Monthly Spending",
                data: [15000, 8000, 5000, 4000, 7000],
                backgroundColor: ["#FF6B35", "#4CAF50", "#2D3142", "#FF8C66", "#E0E0E0"]
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById("optimizationChart").getContext("2d"), {
        type: "doughnut",
        data: {
            labels: ["Current Tax", "Potential Savings", "Optimized Tax"],
            datasets: [{
                data: [78500, 15700, 62800],
                backgroundColor: ["#FF6B35", "#4CAF50", "#2D3142"]
            }]
        },
        options: {
            cutout: "60%",
            plugins: { legend: { position: "bottom" } }
        }
    });

    new Chart(document.getElementById("summaryChart").getContext("2d"), {
        type: "pie",
        data: {
            labels: ["Income", "Expenses", "Savings"],
            datasets: [{
                data: [550000, 45000 * 12, 550000 - (45000 * 12)],
                backgroundColor: ["#FF6B35", "#2D3142", "#4CAF50"]
            }]
        },
        options: {
            plugins: { legend: { position: "bottom" } }
        }
    });

    const chatToggle = document.getElementById("chat-toggle");
    const chatBox = document.getElementById("chat-box");
    const chatMessages = document.getElementById("chat-messages");

    chatToggle.onclick = () => {
        chatBox.style.display = chatBox.style.display === "none" || chatBox.style.display === "" ? "flex" : "none";
    };

    function handleKey(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById("userInput");
        const message = input.value.trim();
        if (message === "") return;

        appendMessage("You", message, "user");
        input.value = "";

        appendMessage("Gemini", "Typing...", "gemini", true);

        fetch("gemini.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: message })
        })
            .then(response => response.json())
            .then(data => {
                const geminiResponse = data?.candidates?.[0]?.content?.parts?.[0]?.text || "⚠️ Gemini gave no usable response.";
                updateLastGeminiMessage(geminiResponse);
            })
            .catch(() => {
                updateLastGeminiMessage("⚠️ Failed to connect to Gemini API.");
            });
    }

    function appendMessage(sender, text, className, isTemp = false) {
        const msgDiv = document.createElement("div");
        msgDiv.className = `message ${className}`;
        msgDiv.innerText = `${sender}: ${text}`;
        if (isTemp) msgDiv.dataset.temp = "true";
        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function updateLastGeminiMessage(newText) {
        const tempMessages = document.querySelectorAll('[data-temp="true"]');
        if (tempMessages.length > 0) {
            tempMessages[tempMessages.length - 1].innerText = `Gemini: ${newText}`;
            tempMessages[tempMessages.length - 1].removeAttribute("data-temp");
        }
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>
</body>
</html>
