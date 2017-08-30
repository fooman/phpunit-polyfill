--DESCRIPTION--

Test phpunit polyfill macros

--GIVEN--

\PHPUnit\Framework\TestCase

$this->createMock('Fooman\Example\Class\GetMock');

$partialMock = $this->createPartialMock(
    'Fooman\Example\Class\PartialMockOne',
    ['create']
);

$partialMock = $this->createPartialMock(
    'Fooman\Example\Class\PartialMockTwo',
    ['create'],
);

$partialMock = $this->createPartialMock(
    'Fooman\Example\Class\PartialMockThree',
    ['create', 'update'],
);

--EXPECT--

\PHPUnit_Framework_TestCase

$this->getMock('Fooman\Example\Class\GetMock',[],[],'',false);

$partialMock = $this->getMock(
    'Fooman\Example\Class\PartialMockOne',
    ['create'],
    [],
    '',
    false
);

$partialMock = $this->getMock(
    'Fooman\Example\Class\PartialMockTwo',
    ['create'],
    [],
    '',
    false
);

$partialMock = $this->getMock(
    'Fooman\Example\Class\PartialMockThree',
    ['create', 'update'],
    [],
    '',
    false
);
