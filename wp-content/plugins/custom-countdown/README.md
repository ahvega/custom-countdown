# Custom Countdown - WordPress Plugin

## Description
Custom Countdown is a flexible and customizable WordPress plugin that allows you to add beautiful countdown timers to your posts and pages using a simple shortcode. The plugin features a comprehensive settings page where you can customize the appearance of your countdown timer to match your website's design.

## Features
- Easy to use shortcode system
- Fully customizable appearance through WordPress admin
- Option to hide countdown after deadline
- Responsive design that looks great on all devices
- Translation-ready (Spanish translation included)
- Clean and maintainable code following WordPress standards
- Lightweight with minimal dependencies

## Installation
1. Download the plugin zip file
2. Go to WordPress admin panel > Plugins > Add New
3. Click on "Upload Plugin" and select the zip file
4. Click "Install Now" and then "Activate"

## Usage

### Basic Shortcode
Add a countdown timer to any post or page using the shortcode: 
```
[countdown deadline="2024-12-31 23:59:59"]

### Shortcode Parameters
- `deadline`: The target date and time (format: YYYY-MM-DD HH:MM:SS)
- `separator`: Custom separator between time units (default: "∙")

### Examples

1. Basic countdown:
```
[countdown deadline="2024-12-31 23:59:59"]
```

2. Countdown with custom separator:
```
[countdown deadline="2024-12-31 23:59:59" separator="|"]
```

3. Christmas countdown:
```
[countdown deadline="2024-12-25 00:00:00" separator="★"]
```

4. Event countdown with dash:
```
[countdown deadline="2024-06-15 18:30:00" separator="-"]
```

### Date Format Explanation
The deadline parameter follows this structure:
- `YYYY`: Four-digit year (e.g., 2024)
- `MM`: Two-digit month (01-12)
- `DD`: Two-digit day (01-31)
- `HH`: Hours in 24-hour format (00-23)
- `MM`: Minutes (00-59)
- `SS`: Seconds (00-59)

### Important Notes
- The deadline must be in the future
- Use 24-hour time format (00:00:00 to 23:59:59)
- Include all parts of the date and time
- Quotes are required around parameter values
- The separator can be any single character or HTML entity

### Common Separator Options
- Dot: `separator="∙"`
- Star: `separator="★"`
- Bullet: `separator="•"`
- Dash: `separator="-"`
- Pipe: `separator="|"`
- Space: `separator=" "`

### Error Handling
The plugin will:
- Display nothing if the deadline has passed
- Use default separator if none specified
- Show error message if date format is invalid

### Settings
Navigate to Settings > Countdown to customize:

#### Display Options
- Hide When Expired: Automatically hide the countdown when the deadline is reached

#### Style Options
- Font Family
