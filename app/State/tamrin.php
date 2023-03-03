<?php

namespace State {
    interface WritingState
    {
        public function write($words);
    }

    class Uppercase implements WritingState
    {
        public function write($words)
        {
            echo strtoupper($words);
        }
    }

    class Lowercase implements WritingState
    {
        public function write($words)
        {
            echo strtolower($words);
        }
    }

    class Defaultcase implements WritingState
    {
        public function write($words)
        {
            echo $words;
        }
    }
    class TextEditor {
        protected $state;
        public function __construct(WritingState $initialState)
        {
            $this->state = $initialState;
        }

        public function setState(WritingState $state)
        {
           $this->state = $state;
        }

        public function type($words)
        {
           $this->state->write($words);
        }
    }
    $editor = new TextEditor(new Defaultcase());

    $editor->type('First line<br>');

    $editor->setState(new UpperCase());

    $editor->type('Second line<br>');
    $editor->type('Third line<br>');

    $editor->setState(new LowerCase());

    $editor->type('Fourth line<br>');
    $editor->type('Fifth line<br>');
}
