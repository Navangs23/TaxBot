<?php include "session_check.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        .input-area {
            background: var(--cardbg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--neumo-shadow);
        }
        .input-area input[type="file"] {
            padding: 0.5rem;
            font-size: 0.9rem;
        }
        .analyze-btn {
            width: auto;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--gradient);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .analyze-btn:hover {
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
            <a href="forecasting.php">Forecasting</a>
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
        <a href="forecasting.php">Forecasting</a>
        <button onclick="logout()">Logout</button>
    </div>
</nav>
<div class="container">
    <h1><i class="fas fa-file-alt"></i> Form 16 Insights Dashboard</h1>

    <div class="input-area">
        <p><strong>Upload your Form 16 PDF</strong> to analyze your tax data automatically.</p>
        <form id="form16Form">
            <div>
                <label>Form 16 PDF</label>
                <input type="file" id="upload" accept=".pdf" required>
            </div>
            <button type="submit" class="analyze-btn">Analyze Form 16</button>
        </form>
        <p class="note">All data will be extracted from the uploaded PDF.</p>
    </div>

    <div class="card grid">
        <div>
            <h2><i class="fas fa-list"></i> Part A</h2>
            <pre id="partA">Waiting for Form 16 data...</pre>
        </div>
        <div>
            <h2><i class="fas fa-list"></i> Part B</h2>
            <pre id="partB">Waiting for Form 16 data...</pre>
        </div>
    </div>

    <div class="card">
        <h2><i class="fas fa-info-circle"></i> Key Tax Details Extracted</h2>
        <ul id="taxDetails">
            <li><strong>PAN:</strong> <span id="panDisplay">N/A</span></li>
            <li><strong>TAN:</strong> <span id="tanDisplay">N/A</span></li>
            <li><strong>Employee Name:</strong> <span id="employeeNameDisplay">N/A</span></li>
            <li><strong>Employer:</strong> <span id="employerDisplay">N/A</span></li>
            <li><strong>Gross Salary:</strong> <span id="grossSalaryDisplay">₹0</span></li>
            <li><strong>HRA:</strong> <span id="hraDisplay">₹0</span></li>
            <li><strong>Standard Deduction:</strong> <span id="standardDeductionDisplay">₹0</span></li>
            <li><strong>Deductions (80C + 80D):</strong> <span id="deductionsDisplay">₹0</span></li>
            <li><strong>Taxable Income:</strong> <span id="taxableIncomeDisplay">₹0</span></li>
            <li><strong>Total TDS Deducted:</strong> <span id="tdsDisplay">₹0</span></li>
            <li><strong>Tax Payable:</strong> <span id="taxPayableDisplay">₹0</span></li>
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
        <h2><i class="fas fa-lightbulb"></i> Tax Tips & Insights</h2>
        <ul id="taxTips">
            <li>Waiting for data to generate tips...</li>
        </ul>
    </div>
</div>

<script>
    function logout() {
        localStorage.removeItem('isLoggedIn');
        window.location.href = 'taxbot-ai.html';
    }

    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('active');
    });

    document.getElementById('form16Form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate PDF upload
        const file = document.getElementById('upload').files[0];
        if (!file || file.type !== 'application/pdf') {
            alert('Please upload a valid Form 16 PDF.');
            return;
        }

        // Simulated data extraction from Form 16 PDF
        const form16Data = {
            employeeName: 'John Doe',           // Replace with real scraping
            pan: 'AAAAA1234A',                 // Replace with real scraping
            tan: 'DELT12345E',                 // Replace with real scraping
            employer: 'ABC Pvt Ltd',           // Replace with real scraping
            grossSalary: 1000000,              // Replace with real scraping
            hra: 120000,                       // Replace with real scraping
            standardDeduction: 50000,          // Replace with real scraping
            deduction80C: 150000,              // Replace with real scraping
            deduction80D: 50000,               // Replace with real scraping
            tds: 75000                         // Replace with real scraping
        };

        // Calculate taxable income and tax payable
        const totalDeductions = form16Data.hra + form16Data.standardDeduction + form16Data.deduction80C + form16Data.deduction80D;
        const taxableIncome = Math.max(0, form16Data.grossSalary - totalDeductions);
        const taxPayable = calculateTax(taxableIncome);

        // Update Part A
        document.getElementById('partA').textContent = `Form 16 - PART A
Employee: ${form16Data.employeeName}
PAN: ${form16Data.pan}
Employer: ${form16Data.employer}
TAN: ${form16Data.tan}
TDS: ₹${form16Data.tds.toLocaleString('en-IN')}`;

        // Update Part B
        document.getElementById('partB').textContent = `Form 16 - PART B
Gross Salary: ₹${form16Data.grossSalary.toLocaleString('en-IN')}
HRA: ₹${form16Data.hra.toLocaleString('en-IN')}
Standard Deduction: ₹${form16Data.standardDeduction.toLocaleString('en-IN')}
80C: ₹${form16Data.deduction80C.toLocaleString('en-IN')}
80D: ₹${form16Data.deduction80D.toLocaleString('en-IN')}
Taxable Income: ₹${taxableIncome.toLocaleString('en-IN')}
Tax Payable: ₹${taxPayable.toLocaleString('en-IN')}`;

        // Update Key Tax Details
        document.getElementById('panDisplay').textContent = form16Data.pan;
        document.getElementById('tanDisplay').textContent = form16Data.tan;
        document.getElementById('employeeNameDisplay').textContent = form16Data.employeeName;
        document.getElementById('employerDisplay').textContent = form16Data.employer;
        document.getElementById('grossSalaryDisplay').textContent = `₹${form16Data.grossSalary.toLocaleString('en-IN')}`;
        document.getElementById('hraDisplay').textContent = `₹${form16Data.hra.toLocaleString('en-IN')}`;
        document.getElementById('standardDeductionDisplay').textContent = `₹${form16Data.standardDeduction.toLocaleString('en-IN')}`;
        document.getElementById('deductionsDisplay').textContent = `₹${(form16Data.deduction80C + form16Data.deduction80D).toLocaleString('en-IN')}`;
        document.getElementById('taxableIncomeDisplay').textContent = `₹${taxableIncome.toLocaleString('en-IN')}`;
        document.getElementById('tdsDisplay').textContent = `₹${form16Data.tds.toLocaleString('en-IN')}`;
        document.getElementById('taxPayableDisplay').textContent = `₹${taxPayable.toLocaleString('en-IN')}`;

        // Generate Tax Tips
        const taxTips = document.getElementById('taxTips');
        taxTips.innerHTML = '';
        taxTips.innerHTML += `<li>Verify TDS (₹${form16Data.tds.toLocaleString('en-IN')}) matches your AIS/26AS statement.</li>`;
        if (form16Data.deduction80C < 150000) {
            taxTips.innerHTML += `<li>Use 80C wisely – invest ₹${(150000 - form16Data.deduction80C).toLocaleString('en-IN')} more (PPF, ELSS) to maximize ₹1.5L limit.</li>`;
        }
        if (form16Data.deduction80D < 25000) {
            taxTips.innerHTML += `<li>80D for Health Insurance – claim ₹${(25000 - form16Data.deduction80D).toLocaleString('en-IN')} more (up to ₹25,000).</li>`;
        }
        if (form16Data.hra > 0) {
            taxTips.innerHTML += `<li>HRA exemption utilized: ₹${form16Data.hra.toLocaleString('en-IN')}. Ensure rent receipts are documented.</li>`;
        }
        taxTips.innerHTML += `<li>Compare old vs new regime: Old tax: ₹${taxPayable.toLocaleString('en-IN')}, New tax: ₹${calculateNewRegimeTax(taxableIncome).toLocaleString('en-IN')}.</li>`;
        taxTips.innerHTML += `<li>File ITR by July 31 to avoid penalties.</li>`;

        // Persist data for other pages (e.g., Forecasting)
        const analysisData = {
            employeeName: form16Data.employeeName,
            pan: form16Data.pan,
            tan: form16Data.tan,
            employer: form16Data.employer,
            grossSalary: form16Data.grossSalary,
            hra: form16Data.hra,
            standardDeduction: form16Data.standardDeduction,
            deduction80C: form16Data.deduction80C,
            deduction80D: form16Data.deduction80D,
            totalDeductions: totalDeductions,
            taxableIncome: taxableIncome,
            tds: form16Data.tds,
            taxPayable: taxPayable
        };
        localStorage.setItem('analysisData', JSON.stringify(analysisData));
    });

    function calculateTax(taxableIncome) {
        let tax = 0;
        if (taxableIncome > 250000) tax += Math.min(taxableIncome - 250000, 250000) * 0.05;
        if (taxableIncome > 500000) tax += Math.min(taxableIncome - 500000, 500000) * 0.20;
        if (taxableIncome > 1000000) tax += (taxableIncome - 1000000) * 0.30;
        return tax + (tax * 0.04); // Including 4% cess
    }

    function calculateNewRegimeTax(taxableIncome) {
        let tax = 0;
        if (taxableIncome > 300000) tax += Math.min(taxableIncome - 300000, 300000) * 0.05;
        if (taxableIncome > 600000) tax += Math.min(taxableIncome - 600000, 300000) * 0.10;
        if (taxableIncome > 900000) tax += Math.min(taxableIncome - 900000, 300000) * 0.15;
        if (taxableIncome > 1200000) tax += Math.min(taxableIncome - 1200000, 300000) * 0.20;
        if (taxableIncome > 1500000) tax += (taxableIncome - 1500000) * 0.30;
        return tax + (tax * 0.04); // Including 4% cess
    }
</script>
</body>
</html>