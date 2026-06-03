from typing import Any

# Passenger WSGI entry point for GoDaddy (or any Phusion Passenger setup)
# The Flask app object is imported from app.py

from app import app as application
