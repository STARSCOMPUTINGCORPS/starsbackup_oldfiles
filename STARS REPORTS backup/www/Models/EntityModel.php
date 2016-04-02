<?php

interface EntityModel
{
  public function getId();
  public function fetch();
  public function getFieldMap();
}
