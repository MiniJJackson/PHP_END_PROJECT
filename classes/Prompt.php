<?php

class Prompt {
    private $name;
    private $cost;
    private $date;
    private $description;
    private $creator;
    private $category;
    private $model;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of cost
     */ 
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     *
     * @return  self
     */ 
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

        /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

            /**
     * Get the value of creator
     */ 
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the value of creator
     *
     * @return  self
     */ 
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

                /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

                    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function save(){
      // conn
      //$conn = Db::getConnection();
      $conn = new PDO('mysql:host=127.0.0.1;dbname=phptest',"root", "");
      // insert query
      
      $statement = $conn->prepare("insert into prompts(`name`, `cost`, `date`, `description`, `creator`, `approved`, `id`, `created_at`, `category`, `model`) values (:name, :cost, :date, :description, :creator, :approved, :id, :created_at, :category, :model)");
      // return result

      $statement->bindValue(":name", $this->name);
      $statement->bindValue(":cost", $this->cost);
      $statement->bindValue(":date", $this->date);
      $statement->bindValue(":description", $this->description);
      $statement->bindValue(":creator", $this->creator);
      $statement->bindValue(":id", uniqid());
      $statement->bindValue(":approved", 0);
      $statement->bindValue(":created_at", date('Y-m-d'));
      $statement->bindValue(":category", $this->category);
      $statement->bindValue(":model", $this->model);

      $result = $statement->execute();
      return $result;

  }
}

?>
