<?php

namespace spec\MrVito\Textify\en_US;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberToTextSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('getInstance', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MrVito\Textify\en_US\NumberToText');
    }

    function it_returns_one_for_1()
    {
        $this->getText(1)->shouldReturn('one');
    }

    function it_returns_two_for_2()
    {
        $this->getText(2)->shouldReturn('two');
    }

    function it_returns_ten_for_10()
    {
        $this->getText(10)->shouldReturn('ten');
    }

    function it_returns_eleven_for_11()
    {
        $this->getText(11)->shouldReturn('eleven');
    }

    function it_returns_twenty_for_20()
    {
        $this->getText(20)->shouldReturn('twenty');
    }

    function it_returns_twenty_one_for_21()
    {
        $this->getText(21)->shouldReturn('twenty one');
    }

    function it_returns_fifty_five_for_55()
    {
        $this->getText(55)->shouldReturn('fifty five');
    }

    function it_returns_one_hundred_for_100()
    {
        $this->getText(100)->shouldReturn('one hundred');
    }

    function it_returns_two_hundred_for_200()
    {
        $this->getText(200)->shouldReturn('two hundred');
    }

    function it_returns_one_hundred_and_one_for_101()
    {
        $this->getText(101)->shouldReturn('one hundred and one');
    }

    function it_returns_two_hundred_and_five_for_205()
    {
        $this->getText(205)->shouldReturn('two hundred and five');
    }

    function it_returns_two_hundred_and_ten_for_210()
    {
        $this->getText(210)->shouldReturn('two hundred and ten');
    }

    function it_returns_two_hundred_and_twenty_three_for_2223()
    {
        $this->getText(223)->shouldReturn('two hundred and twenty three');
    }

    function it_returns_one_thousand_and_one_for_1001()
    {
        $this->getText(1001)->shouldReturn('one thousand and one');
    }

    function it_returns_one_thousand_one_hundred_for_1100()
    {
        $this->getText(1100)->shouldReturn('one thousand, one hundred');
    }

    function it_returns_one_thousand_one_hundred_and_one_for_1101()
    {
        $this->getText(1101)->shouldReturn('one thousand, one hundred and one');
    }

    function it_returns_one_thousand_one_hundred_and_twenty_three_for_1123()
    {
        $this->getText(1123)->shouldReturn('one thousand, one hundred and twenty three');
    }

    function it_returns_two_hundred_and_thirty_four_thousand_one_hundred_and_twenty_three_for_234123()
    {
        $this->getText(234123)->shouldReturn('two hundred and thirty four thousand, one hundred and twenty three');
    }

    function it_returns_one_million_and_one_for_1000001()
    {
        $this->getText(1000001)->shouldReturn('one million and one');
    }

    function it_returns_one_million_one_thousand_and_one_for_1001001()
    {
        $this->getText(1001001)->shouldReturn('one million, one thousand and one');
    }

    function it_returns_one_million_one_thousand_and_twenty_three_for_1001023()
    {
        $this->getText(1001023)->shouldReturn('one million, one thousand and twenty three');
    }

    function it_returns_one_million_twenty_three_thousand_and_forty_five_for_1023045()
    {
        $this->getText(1023045)->shouldReturn('one million, twenty three thousand and forty five');
    }

    function it_returns_one_million_twenty_three_thousand_two_hundred_and_thirty_four_for_1023234()
    {
        $this->getText(1023234)->shouldReturn('one million, twenty three thousand, two hundred and thirty four');
    }
}
