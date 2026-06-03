from flask import Flask, render_template, jsonify, request, abort
import os, json

app = Flask(__name__)

# Load portfolio data once at startup
DATA_FILE = os.path.join(app.root_path, 'data', 'portfolio_data.json')
with open(DATA_FILE, 'r', encoding='utf-8') as f:
    portfolio_data = json.load(f)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/api/data')
def api_data():
    return jsonify(portfolio_data)

@app.route('/api/contact', methods=['POST'])
def contact():
    # Simple validation – in production you'd integrate Flask-Mail
    data = request.get_json()
    if not data or not data.get('name') or not data.get('email') or not data.get('message'):
        abort(400, description='Missing required fields')
    # For now just echo back success
    return jsonify({'status': 'success'}), 200

if __name__ == '__main__':
    app.run(debug=True)
