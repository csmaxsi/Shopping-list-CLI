
<?php

class ShoppingListItem {
    private int $itemID;
    private string $itemName;
    
    public function __construct(int $itemID,string $itemName)
    {
        $this->itemID = $itemID;
        $this->itemName = $itemName;
    }
    
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
    
    public function __construct()
    {
        $this->items = [];
    }
    
    public function getItems(): array
    {
        return $this->items;
    }
    
    public function addItem(ShoppingListItem $item): void
    {
        $this->items[] = $item;
    }
    
    public function removeItem(int $index): void
    {
        //$index = array_search($item, $this->items);
        //$this->unset(items[$item]);
        array_splice($this->items,$index,1);
    }
    
    public function getItemsAsString(): string
    {       
        $items=$this->getItems();
        $stringArray=[];
        $counter=1;
        foreach($items as $index =>$item)
        {
            $stringArray[]= "$index. ".$item->getItemName();
        }
        
        return implode("\n",$stringArray);
        
    }
    
    
}

class ShoppingListCommandPrompt
{   
    private ShoppingList $shoppingList;
    
    public function  __construct(ShoppingList $shoppingList)
    {
        $this->shoppingList = $shoppingList;
    }
    
    public function startFlow(): void
    {
        $this->showMainMessage();
        $answer = $this->getAnswer("");
        
        
        switch($answer)
        {   
            case 1:
                $itemsList=$this->shoppingList->getItemsAsString();
                $this->showMessage($itemsList);
                echo "\n";
                break;
                
            case 2:
                $itemName= $this->getAnswer("Enter item name: ");
                $item=new ShoppingListItem(4,$itemName);
                $this->shoppingList->addItem($item);
                $this->showMessage("Item added successfully\n");
                break;
                
            case 3:
                $itemsList=$this->shoppingList->getItemsAsString();
                $this->showMessage($itemsList);
                $stringItem= $this->getAnswer("\nEnter the index to delete: \n");
                $itemIndex=(int)$stringItem;
                $this->shoppingList->removeItem($itemIndex);
                echo "Item Deleted successfully !\n";
                break;
            case 4:
                break;
            default:
                $this->showMessage("Unsupported input");
                
        }
        
        $this->startFlow();
    }
    
    
    
    public function showMessage(string $message): void
    {
        echo $message;
    }
    
    public function getAnswer(string $question): string 
    {
        $answer=readline($question);
        return $answer;
    }
    
    public function showMainMessage(): void
    {
        $this->showMessage("\nchoose an option : \n\n1. Show items \n2. Add Item \n3. Delete Item \n4. Exit\n");
    }
}

$shoppingList = new ShoppingList();

$shoppingListCommandPrompt = new ShoppingListCommandPrompt($shoppingList);
$shoppingListCommandPrompt->startFlow();



?>
