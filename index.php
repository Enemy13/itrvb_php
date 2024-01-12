<?php

class User
{
    public int $id;
    public string $userName;
    public string $email;
    public string $phoneNumber;
    private float $personalDiscount;

    function __construct(int $id, string $userName, string $email, string $phoneNumber = null)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function setPersonalDiscount(float $personalDiscount): void
    {
        if ($personalDiscount >= 0 && $personalDiscount <= 1) {
            $this->personalDiscount = $personalDiscount;
        } else {
            throw new InvalidArgumentException('Скидка должна быть от 0% до 100%');
        }
    }

    public function getPersonalDiscount(): float
    {
        return $this->personalDiscount;
    }
}

class Product
{
    public int $id;
    public string $name;
    public int $price;
    public string $img;

    function __construct(int $id, string $name, int $price, string $img)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->img = $img;
    }

}

class FullProduct extends Product
{
    public string $discription;
    public float $weight;

    function __construct(int $id, string $name, int $price, string $img, string $discription, float $weight)
    {
        parent::__construct($id, $name, $price, $img);

        $this->discription = $discription;
        $this->weight = $weight;
    }
}


class Cart
{
    public int $userId;
    private array $products = [];

    function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    function addProduct(int $productId, int $count): void
    {
        if ($count <= 0)
            throw new InvalidArgumentException('Кол-во должно быть больше 0');

        $this->products = [$productId => $count];
    }

    function recountProduct(int $productId, int $count): void
    {
        if ($count <= 0)
            throw new InvalidArgumentException('Кол-во должно быть больше 0');

        $this->products[$productId] = $count;
    }

    function removeProduct(int $productId): void
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        } else {
            throw new InvalidArgumentException('Товар не найден в корзине');
        }
    }

    function clearCart(): void
    {
        $this->products = [];
    }

    function getPrice(array $products): int
    {
        throw new RuntimeException('Метод еще не реализован');
    }
}

class Review
{
    public int $userId;
    public int $productId;
    public float $rating;
    public string $text;
    public DateTime $date;

    public function __construct(int $userId, int $productId, float $rating, string $text, DateTime $date)
    {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->text = $text;
        $this->date = $date;

        $this->setRating($rating);
    }

    public function setRating(float $rating): void
    {
        if ($rating < 0 || $rating > 5)
            throw new InvalidArgumentException('Рейтинг должен быть от 0 до 5 включительно');

        $this->rating = $rating;
    }
}

class FeedBack
{
    public string $name;
    public string $email;
    public string $text;

    public function __construct(string $name, string $email, string $text)
    {
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
    }
}