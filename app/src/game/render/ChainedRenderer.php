<?php

namespace app\game\render;

abstract class ChainedRenderer implements IRenderer{
    private $nextRenderer;

    public function next(){
        return $this->nextRenderer;
    }

    public function appendRender($nextRenderer){
        $this->nextRenderer = $nextRenderer;
    }

    public function render($data, $object){
        if($this->nextRenderer){
            return $this->nextRenderer->render($this->renderData($data, $object), $object);
        }else{
            return $this->renderData($data, $object);
        }
    }

    public abstract function renderData($data, $object);

}
