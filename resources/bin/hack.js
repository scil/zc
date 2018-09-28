#!/usr/bin/env node
/**
 * hack source file within a third-party package
 *
 * e.g.
 * resources/bin/hack.js -c full
 */
const fs = require('fs');
const replace = require('replace-in-file');
const assert = require('assert')
const program = require('commander');

// no, part, full
const default_check_level = 'part';

const default_lang_if_no_zh_header = 'en';
const project_root = fs.realpathSync(__dirname + '/../..')
const hack_files_root = fs.realpathSync(project_root + '/resources/hack')


program
    .version('0.0.1')
    .usage('hack vendor file according const map')
    .option('-c, --check_level [value]', 'no, part, full')
    .parse(process.argv);

const check_level = program.check_level || default_check_level;

const map = {
    'LaravelLocalization.php': {
        'enable':true,
        'desc': `any non-zh browsers visits non-local url,like "/being", will be thought to use locale "en", then 
            LaravelLocalizationRedirectFilter will redirect to "/en/being" `,
        'origin': '/vendor/mcamara/laravel-localization/src/Mcamara/LaravelLocalization/LaravelLocalization.php',

        'type': 'replace-in-file',
        'from': '  $this->currentLocale = $this->defaultLocale;',
        'to': [
            '  // hack.js $this->currentLocale = $this->defaultLocale;',
            '                $this->currentLocale = (new LanguageNegotiator("'
            + default_lang_if_no_zh_header
            + '", $this->getSupportedLocales(), $this->request))->negotiateLanguage();',
        ].join('\n'),
    },


};

for (let i in map) {

    if(!map[i]['enable']) continue;

    if (check_level !== 'no') {
        origin_file = project_root + map[i]['origin']
        let full = fs.readFileSync(origin_file).toString().replace(/\s+/g, ' ');
        $part = checkPart(i, full, origin_file)
        assert.strictEqual($part, true)
        if (check_level === 'full') {
            $full = checkFull(i, full)
            assert.strictEqual($full, true)
        }
    }

    replace_in_file(i, map[i])
}

function replace_in_file(item, info) {
    let origin = project_root + info.origin;

    const options = {files: origin, from: info.from, to: info.to,};

    try {
        const changes = replace.sync(options);
        console.log('Modified files:', changes.join(', '));
    }
    catch (error) {
        console.error('Error occurred:', error);
    }
}

function checkFull(item, full, origin_file) {

    let backup_file = hack_files_root + '/backup/' + item

    let back_full = fs.readFileSync(backup_file).toString().replace(/\s+/g, ' ');

    if (back_full !== full) {

        diffOPtions = '--ignore-all-space --ignore-blank-lines';
        $cmdArguments = `$diffOPtions $backup_file $origin_file `;
        console.log("\n\n[CMD] diff $cmdArguments\n\n")
        return;
    }

    return true;

}

function checkPart(item, full) {

    let part_file = hack_files_root + '/part/' + item;

    if (!fs.statSync(part_file).isFile()) {
        console.log('no part file ', part_file)
        return true;
    }

    let parts = fs.readFileSync(part_file).toString().split("===A===");
    /**
     * @type {string}
     */

    for (let part of parts) {
        part = part.replace(/\s+/g, ' ')
        if (full.indexOf(part) === -1) {
            console.log(part_file, 'part :', part)
            return false;
        }


    }
    return true;

}
