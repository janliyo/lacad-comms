import os
import sys
import subprocess
from pathlib import Path

def run_inference(file_path):
    try:
        # Path to detect.py script
        detect_script_path = os.path.join(os.path.dirname(__file__), 'yolo-files', 'detect.py')
        # Path to weights file
        weights_path = os.path.join(os.path.dirname(__file__), 'yolo-files', 'models', 'yolov7.pt')
        # Confidence threshold
        conf_threshold = 0.4
        # Image size
        img_size = 640
        # Output directory
        output_dir = os.path.join(os.path.dirname(file_path), 'output')

        # Ensure the output directory exists
        os.makedirs(output_dir, exist_ok=True)

        # Command to run detect.py
        command = [
            sys.executable, detect_script_path,
            '--weights', weights_path,
            '--conf', str(conf_threshold),
            '--img-size', str(img_size),
            '--source', file_path,
            '--project', output_dir,
            '--name', 'result',
            '--exist-ok'
        ]

        print(f"Running command: {' '.join(command)}")

        # Run the command
        result = subprocess.run(command, capture_output=True, text=True)

        # Check if the process was successful
        if result.returncode == 0:
            print("Inference completed successfully.")
            print("Output:", result.stdout)
        else:
            print("Inference failed.")
            print("Error:", result.stderr)

    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == '__main__':
    if len(sys.argv) != 2:
        print("Usage: python yolo_inference.py <file_path>")
        sys.exit(1)

    file_path = sys.argv[1]
    run_inference(file_path)
