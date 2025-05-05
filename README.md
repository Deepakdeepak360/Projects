💼 AI Sales Predictor
A web-based sales prediction application that uses machine learning (XGBoost) to forecast future sales based on historical data. The app integrates PHP, Python, and JavaScript to deliver an interactive and user-friendly experience.

🚀 Features
📁 Upload CSV files containing historical sales data

🤖 AI-powered sales prediction using XGBoost

📊 Interactive visualization with Chart.js

📅 30-day sales forecast

📥 Downloadable prediction results

📱 Responsive web design

🛠️ Technologies Used
🔹 Frontend
HTML5

CSS3 (with animations and responsive design)

JavaScript

Chart.js for data visualization

🔹 Backend
PHP (7.0+) for server-side logic

Python for machine learning execution

XGBoost for predictive modeling

Pandas for data processing

⚙️ Getting Started
1. Prerequisites
Make sure the following are installed:

PHP 7.0 or higher

Python 3.x

Required Python packages: pandas, xgboost

2. Install Python dependencies
bash
Copy
Edit
pip install pandas xgboost
3. Start PHP development server
bash
Copy
Edit
php -S 127.0.0.1:5500 -t .
4. Open your browser and visit:
cpp
Copy
Edit
http://127.0.0.1:5500
📄 Input Data Format
The uploaded CSV should follow this format:

python-repl
Copy
Edit
date,sales
2023-01-01,169
2023-01-02,188
...
🔍 Feature Details
📂 1. Data Upload
Accepts .csv files with historical sales data

Validates file format and content

🤖 2. AI Prediction
XGBoost regression model

Input features:

Previous day sales

Day of the week

Month

3-day rolling average

📈 3. Visualization
Interactive chart of predicted values (Chart.js)

Tabular display of prediction results

CSV download of forecasted data

📌 Notes
The system generates a 30-day forecast

Predictions are based on historical trends, seasonality, and weekly patterns

Results can be downloaded in .csv format for further analysis

🔐 Security Features
Input validation for uploaded files

Escaped shell arguments for safe execution

Error handling and logging

Secure file operations to prevent code injection or path traversal

📊 Project Objective
This project showcases how modern web technologies can integrate with machine learning to build practical, insightful business intelligence tools.
