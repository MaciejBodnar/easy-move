#!/bin/bash

echo "🚀 Building Theme for Production Deployment..."

# Build assets for production
echo "📦 Building Tailwind CSS and assets..."
npm run build

# Create deployment folder name with timestamp
DEPLOY_FOLDER="clin-city-$(date +%Y%m%d-%H%M)"

echo "📁 Creating deployment folder: $DEPLOY_FOLDER"
mkdir -p "$DEPLOY_FOLDER"

echo "📋 Copying essential files only..."

# Copy WordPress theme files (required)
cp functions.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  functions.php not found"
cp style.css "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  style.css not found"
cp index.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  index.php not found"
cp 404.php "$DEPLOY_FOLDER/" 2>/dev/null || echo "ℹ️  404.php not found (optional)"

# Copy essential directories
echo "   ✓ Copying Blade templates..."
mkdir -p "$DEPLOY_FOLDER/resources"
cp -r resources/views "$DEPLOY_FOLDER/resources/"

echo "   ✓ Copying built assets (CSS/JS)..."
mkdir -p "$DEPLOY_FOLDER/public"
cp -r public/build "$DEPLOY_FOLDER/public/"

echo "   ✓ Copying images..."
mkdir -p "$DEPLOY_FOLDER/resources"
cp -r resources/images "$DEPLOY_FOLDER/resources/" 2>/dev/null || echo "⚠️  resources/images/ not found"

echo "   ✓ Copying CSS source files..."
cp -r resources/css "$DEPLOY_FOLDER/resources/" 2>/dev/null || echo "⚠️  resources/css/ not found"

echo "   ✓ Copying JavaScript source files..."
cp -r resources/js "$DEPLOY_FOLDER/resources/" 2>/dev/null || echo "⚠️  resources/js/ not found"

echo "   ✓ Copying theme logic..."
cp -r app "$DEPLOY_FOLDER/"

echo "   ✓ Copying PHP dependencies..."
cp -r vendor "$DEPLOY_FOLDER/" 2>/dev/null || echo "⚠️  vendor/ not found - run 'composer install'"

# Copy composer files if they exist
cp composer.json "$DEPLOY_FOLDER/" 2>/dev/null || echo "ℹ️  composer.json not found"

echo "✅ Production theme folder created: $DEPLOY_FOLDER"
echo ""
echo "📁 Upload this entire folder to your hosting:"
echo "   /htdocs/wp-content/themes/clin-city/"
echo ""
echo "🌐 Your Tailwind CSS will work on the hosting server"

# Show what's included
echo ""
echo "📋 Deployment folder includes:"
echo "   ✓ functions.php, style.css, index.php"
echo "   ✓ resources/views/ (Blade templates)"
echo "   ✓ resources/images/ (Theme images)"
echo "   ✓ resources/css/ (CSS source files including app.css)"
echo "   ✓ resources/js/ (JavaScript source files)"
echo "   ✓ public/build/ (Built CSS/JS with Tailwind)"
echo "   ✓ app/ (Theme logic & ACF helpers)"
echo "   ✓ vendor/ (PHP dependencies)"
echo ""
echo "❌ Deployment folder excludes:"
echo "   ✗ node_modules/ (not needed)"
echo "   ✗ package.json, vite.config.js (dev tools)"
echo "   ✗ .git/, .env files (development)"

# Show folder size
FOLDER_SIZE=$(du -sh "$DEPLOY_FOLDER" | cut -f1)
echo ""
echo "📊 Deployment folder size: $FOLDER_SIZE"


# Create ZIP archive for easy upload to Infinity Free
echo ""
echo "📦 Creating ZIP archive for upload..."
ZIP_FILE="${DEPLOY_FOLDER}.zip"
zip -r -q "$ZIP_FILE" "$DEPLOY_FOLDER"
ZIP_SIZE=$(du -sh "$ZIP_FILE" | cut -f1)

echo "✅ ZIP archive created: $ZIP_FILE"
echo "📊 ZIP size: $ZIP_SIZE"
echo ""
echo "📝 UPLOAD INSTRUCTIONS:"
echo "   1. Download/copy this ZIP file to your computer"
echo "   2. Log into Infinity Free File Manager"
echo "   3. Navigate to: public_html/wp-content/themes/"
echo "   4. Upload the ZIP file (single file - no errors!)"
echo "   5. Right-click the ZIP → Extract/Unzip"
echo "   6. Delete the ZIP file after extraction"
echo "   7. Log into WordPress and activate the theme"
echo ""
echo "✨ Done! Theme is ready to use."
