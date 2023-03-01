
<?php

class forumagora
{
    private Author $author;
    private string $title;
    private string $content;
    private \DateTime $date;

    // ..

    public function getData(): array
    {
        return [
            'author' => $this->author->fullName(),
            'title' => $this->title,
            'content' => $this->content,
            'timestamp' => $this->date->getTimestamp(),
        ];
    }
}

interface interforumagora
{
    public function print(forumagora $forumagora);
}

class JsonforumagoraPrinter implements interforumagora
{
    public function print(forumagora $forumagora)
    {
        return json_encode($forumagora->getData());
    }
}

class HtmlforumagoraPrinter implements interforumagora
{
    public function print(forumagora $forumagora)
    {
        return `<article>
                    <h1>{$forumagora->getTitle()}</h1>
                    <article>
                        <h2>{$forumagora->getDate()->format('Y-m-d H:i:s')} - {$forumagora->getAuthor()->fullName()}</h2>
                        <p>{$forumagora->getContent()}</p>
                    </article>
                </article>`;
    }
}