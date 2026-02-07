
## Installation
1. Copy each plugin into its respective Moodle directory:
   - `qbank_yetkinlik` → `moodle/question/qbank/yetkinlik`
   - `local_yetkinlik` → `moodle/local/yetkinlik`
2. In Moodle, go to **Site administration → Plugins → Install plugins**.
3. Complete the installation wizard.
4. Purge caches.

## Usage
- Use **qbank_yetkinlik** to assign competencies to questions in the question bank.
- Use **local_yetkinlik** to generate analysis, reports, and feedback based on those assignments.

## Development
- Source JS files are located in `amd/src`.
- After changes, run `grunt amd` to regenerate `amd/build` files.
- Language files are located in `lang/en` and `lang/tr`.

## License
This repository is distributed under the GNU GPL v3 license.