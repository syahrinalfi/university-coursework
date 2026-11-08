from flask import Flask, render_template, request, redirect, url_for
from ultralytics import YOLO
import os
from werkzeug.utils import secure_filename
import cv2
import shutil  # Tambahkan import shutil

app = Flask(__name__)

# Configure paths
UPLOAD_FOLDER = 'static/uploads'
PREDICTION_FOLDER = 'static/predictions'
MODEL_PATH = 'best.pt'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['PREDICTION_FOLDER'] = PREDICTION_FOLDER

# Load YOLO model
model = YOLO(MODEL_PATH)

# Ensure directories exist
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
os.makedirs(PREDICTION_FOLDER, exist_ok=True)

@app.route('/')
def upload_file():
    return render_template('upload.html')

@app.route('/predict', methods=['POST'])
def predict():
    if 'file' not in request.files:
        return redirect(request.url)

    file = request.files['file']
    if file.filename == '':
        return redirect(request.url)

    if file:
        # Save uploaded file
        filename = secure_filename(file.filename)
        upload_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(upload_path)

        # Ensure the result folder is cleared or recreated
        result_folder = os.path.join(app.config['PREDICTION_FOLDER'], 'result')
        if os.path.exists(result_folder):
            shutil.rmtree(result_folder)

        # Perform prediction
        results = model.predict(source=upload_path, save=True, project=app.config['PREDICTION_FOLDER'], name='result')

        # Get predicted image path
        predicted_image_path = os.path.join(result_folder, filename)

        return render_template('result.html', uploaded_image=upload_path, predicted_image=predicted_image_path)

if __name__ == '__main__':
    app.run(debug=True)
