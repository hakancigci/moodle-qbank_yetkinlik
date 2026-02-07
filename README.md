# Moodle Competency Plugins

This repository contains two Moodle plugins designed to enhance competency-based assessment and reporting:

- **qbank_yetkinlik**: Enables competency mapping within the question bank. Teachers can link questions to specific competencies for more structured evaluation.
- **local_yetkinlik**: Provides competency analysis and reporting tools. Includes PDF export with multilingual support (EN/TR) and personalized motivational feedback for students.

---

## Installation

1. Ensure your Moodle version is **5.0 or higher**.
2. Copy the `qbank_yetkinlik` folder into `question/bank/`.
3. Copy the `local_yetkinlik` folder into `local/`.
4. Log in as an administrator and complete the plugin installation process.
5. Verify that both plugins are enabled in the Moodle admin panel.

---

## Features

- Competency mapping for questions.
- Competency-based reporting and analysis.
- PDF export with multilingual support (English/Turkish).
- Motivational feedback generation for learners.
- Clean architecture with redundant endpoints removed.
- Fully localized language files (EN/TR).

---

## Requirements

- Moodle **5.0+**
- PHP and SQL database support (standard Moodle requirements).

---

## License

This project is licensed under the **GNU GPL v3**. See the [LICENSE](LICENSE) file for details.

---

## Contributing

Contributions, bug reports, and feature requests are welcome. Please open an issue or submit a pull request.

---

## Releases

See the [Releases](https://github.com/hakancigci/moodle_yetkinlik_plugins/releases) section for detailed changelogs and downloadable packages.
