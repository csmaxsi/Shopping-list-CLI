<?php

class ShoppingListItem {
    private int $itemID;
    private string $itemName;
    
    public function getItemId(): int
    {
        return $this->itemID;    
    }
    
    public function getItemName(): string
    {
        return $this->itemName;
    }
    
    public function setItemID(int $itemID): void 
    {
        $this->itemID = $itemID;
    }
    
    public function setItemName(string $itemName): void
    {
        $this->itemName = $itemName;
    }
    
}

class ShoppingList {
    private array $items;
    
    public function getItems(): array
    {
        return $this->items;
    }
    
    public function addItem(ShoppingListItem $item): void
    {
        $this->items[] = $item;
    }
    
    public function removeItem(ShoppingListItem $item): void
    {
        $index = array_search($item, $this->items);
        //$this->unset(items[$item]);
        array_splice($this->items,$index,1);
    }
}

$item1 = new ShoppingListItem();
$item1->setItemID(1);
$item1->setItemName("Orange");

$item2 = new ShoppingListItem();
$item2->setItemID(2);
$item2->setItemName("Apple");

$shoppingList1= new ShoppingList();
$shoppingList1->addItem($item1);
$shoppingList1->addItem($item2);

//$shoppingList1->getitems();
$arr = $shoppingList1->getitems();

print_r($arr);

?>
