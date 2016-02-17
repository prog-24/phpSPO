<?php
    
namespace SharePoint\PHP\Client;


/**
 * List client object
 */
class SPList extends ClientObject
{
    private $title;

    public function setTitle($value)
    {
        $this->title = $value;
    }


    public function addItem(array $listItemCreationInformation)
    {
        $resoursePath = $this->getResourcePath() . "/items";
        $item = new ListItem($this->getContext(),$resoursePath,null,$listItemCreationInformation);
        $qry = new ClientQuery($item,ClientOperationType::Create);
        $this->getContext()->addQuery($qry);
        return $item;
    }

    public function getItemById($id)
    {
        $resoursePath = $this->getResourcePath() . "/items({$id})";
        $item = new ListItem($this->getContext(),$resoursePath);
        return $item;
    }


    public function getItems()
    {
        $resoursePath = $this->getResourcePath() . "/items";
        $items = new ListItemCollection($this->getContext(),$resoursePath);
        return $items;
    }

    public function update($listUpdationInformation)
    {
        $this->payload = $listUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }
}