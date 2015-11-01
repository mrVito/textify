# textify
Convert numbers and currency to a readable text

## Installation
Just require the package from composer:
`require mrvito/textify`

## Usage
Create an instance of NumberToText class from a correct namespace for your language
i.e. for english:

    use MrVito\Textify\en_US\NumberToText;
    $numberToText = NumberToText::getInstance();
    
And just use the method you want...:

    $text = $numberToText->getText(123);
    
    echo $text;
    
Outputs:

    one hundred and twenty three