<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 16 Detailed Insights</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
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
            letter-spacing: 1px;
        }
        .nav-links {
            display: none;
            gap: 2rem;
            align-items: center;
        }
        @media (min-width: 768px) {
            .nav-links { display: flex; }
        }
        .nav-links a, .nav-links button {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-links a:hover, .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
        }
        .nav-links button {
            background: white;
            color: var(--primary);
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        .nav-links button:hover {
            background: #F0F0F0;
            box-shadow: var(--shadow);
        }
        .mobile-menu-btn {
            display: block;
            font-size: 1.5rem;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }
        @media (min-width: 768px) {
            .mobile-menu-btn { display: none; }
        }
        .mobile-menu {
            display: none;
            background: var(--cardbg);
            padding: 1rem;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            box-shadow: var(--shadow);
        }
        .mobile-menu.active { display: block; }
        .mobile-menu a, .mobile-menu button {
            display: block;
            color: var(--secondary);
            padding: 0.5rem;
            text-decoration: none;
            font-weight: 500;
        }
        .mobile-menu button {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            width: 100%;
            margin-top: 0.5rem;
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .card {
            background: var(--cardbg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--neumo-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            font-size: 1.3rem;
            color: var(--secondary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card h3 {
            font-size: 1.1rem;
            color: var(--secondary);
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        .card p {
            font-size: 0.9rem;
            color: var(--secondary);
            opacity: 0.8;
        }
        .upload-area {
            background: var(--cardbg);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: var(--neumo-shadow);
        }
        .upload-btn {
            width: auto;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--gradient);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .upload-btn:hover {
            background: linear-gradient(135deg, #e65a2e, #FF6B35);
            box-shadow: 0 0 15px rgba(255, 107, 53, 0.5);
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        ul {
            padding-left: 1.5rem;
            color: var(--secondary);
            opacity: 0.8;
            font-size: 0.9rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 0.9rem;
            color: var(--secondary);
        }
        th {
            background-color: #eaf3fe;
        }
        .note {
            font-size: 0.85rem;
            color: var(--secondary);
            opacity: 0.6;
            margin-top: 0.5rem;
        }
        pre {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            white-space: pre-wrap;
            color: var(--secondary);
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <span class="nav-logo">TaxBot AI</span>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="taxy.php">Tax Planner</a>
            <a href="analysis.php" class="active">Analysis</a>
            <button onclick="logout()">Logout</button>
        </div>
        <button class="mobile-menu-btn" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="mobile-menu" id="mobile-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="taxy.php">Tax Planner</a>
        <a href="analysis.php">Analysis</a>
        <button onclick="logout()">Logout</button>
    </div>
</nav>
<div class="container">
    <h1><i class="fas fa-file-alt"></i> Form 16 Insights Dashboard</h1>

    <div class="upload-area">
        <p><strong>Upload your Form 16 PDF</strong> to analyze income and tax data.</p>
        <input type="file" id="upload" accept=".pdf" hidden />
        <button class="upload-btn" onclick="document.getElementById('upload').click()">Upload PDF</button>
       <!-- <p class="note">No real PDF parsing here — simulation only.</p>-->
    </div>

    <div class="card grid">
        <div>
            <h2><i class="fas fa-list"></i> Part A</h2>
            <pre id="partA">Waiting for Form 16 upload...</pre>
        </div>
        <div>
            <h2><i class="fas fa-list"></i> Part B</h2>
            <pre id="partB">Waiting for Form 16 upload...</pre>
        </div>
    </div>

    <div class="card">
        <h2><i class="fas fa-info-circle"></i> Key Tax Details Extracted</h2>
        <ul>
            <li><strong>PAN:</strong> AAAAA1234A</li>
            <li><strong>TAN:</strong> DELT12345E</li>
            <li><strong>Employer:</strong> ABC Pvt Ltd</li>
            <li><strong>Gross Salary:</strong> ₹10,00,000</li>
            <li><strong>HRA:</strong> ₹1,20,000</li>
            <li><strong>Standard Deduction:</strong> ₹50,000</li>
            <li><strong>Deductions (80C + 80D):</strong> ₹2,00,000</li>
            <li><strong>Taxable Income:</strong> ₹6,30,000</li>
            <li><strong>Total TDS Deducted:</strong> ₹75,000</li>
            <li><strong>Tax Payable:</strong> ₹45,000</li>
        </ul>
    </div>

    <div class="card">
        <h2><i class="fas fa-table"></i> Tax Regimes & Slabs</h2>
        <h3>Old Tax Regime (FY 2023-24)</h3>
        <table>
            <tr><th>Income Range</th><th>Tax Rate</th></tr>
            <tr><td>Up to ₹2.5L</td><td>0%</td></tr>
            <tr><td>₹2.5L – ₹5L</td><td>5%</td></tr>
            <tr><td>₹5L – ₹10L</td><td>20%</td></tr>
            <tr><td>Above ₹10L</td><td>30%</td></tr>
        </table>

        <h3>New Tax Regime (FY 2023-24)</h3>
        <table>
            <tr><th>Income Range</th><th>Tax Rate</th></tr>
            <tr><td>Up to ₹3L</td><td>0%</td></tr>
            <tr><td>₹3L – ₹6L</td><td>5%</td></tr>
            <tr><td>₹6L – ₹9L</td><td>10%</td></tr>
            <tr><td>₹9L – ₹12L</td><td>15%</td></tr>
            <tr><td>₹12L – ₹15L</td><td>20%</td></tr>
            <tr><td>Above ₹15L</td><td>30%</td></tr>
        </table>

        <p class="note"><strong>Note:</strong> New regime doesn't allow most deductions (80C, 80D, HRA, etc.).</p>
    </div>

    <div class="card">
        <h2><i class="fas fa-lightbulb"></i> Tax Tips & Literacy</h2>
        <ul>
            <li>Verify that TDS matches your AIS/26AS statement</li>
            <li>Use 80C wisely – max ₹1.5L (PPF, ELSS, Life Insurance, etc.)</li>
            <li>80D for Health Insurance – up to ₹25,000 (₹50,000 for senior parents)</li>
            <li>Home loan interest can give benefit under Section 24(b)</li>
            <li>Use standard deduction of ₹50,000 for salaried individuals</li>
            <li>Compare old vs new regime before filing ITR</li>
            <li>Deadline: File ITR by July 31 to avoid penalties</li>
        </ul>
    </div>
</div>

<script>
    const partA = document.getElementById("partA");
    const partB = document.getElementById("partB");

    document.getElementById("upload").addEventListener("change", function () {
        const file = this.files[0];
        if (!file || file.type !== "application/pdf") {
            alert("Please upload a PDF file.");
            return;
        }

        const simulatedText = `Form 16 - PART A\nEmployee: John Doe\nPAN: AAAAA1234A\nEmployer: ABC Pvt Ltd\nTAN: DELT12345E\nTDS: ₹75,000\n--- PART B ---\nGross Salary: ₹10,00,000\nHRA: ₹1,20,000\nStandard Deduction: ₹50,000\n80C: ₹1,50,000\n80D: ₹50,000\nTaxable Income: ₹6,30,000\nTax Payable: ₹45,000`;
        const [a, b] = simulatedText.split('--- PART B ---');

        partA.textContent = a.trim();
        partB.textContent = b.trim();
    });

    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('active');
    });

    function logout() {
        localStorage.removeItem('isLoggedIn');
        window.location.href = 'taxbot-ai.html';
    }
</script>
</body>
</html>