<template>
<div ref="page" class="bg-white">
   <div>
      <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
         <div data-html2canvas-ignore="true" class="flex flex-wrap items-baseline justify-between border-b border-gray-200 pt-10 mb-4 md:mb-0">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 mb-5">Personalizar cover</h1>
            <div class="flex items-center">
               <button @click="handlerFinish" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center mb-4 md:mb-0">
                  <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                  </svg>
                  <span class="ml-1">Finalizar</span>
               </button>
            </div>
         </div>
         <section aria-labelledby="products-heading" class="pb-10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10">
               <div class="py-6">
                  <div data-html2canvas-ignore="true">
                     <div class="grid grid-cols-[120px_1fr] gap-6 mb-4">
                        <div class="text-xl">Parte trasera</div>
                        <div class="flex flex-wrap gap-3">
                           <div
                              v-for="item in colors.back"
                              :key="item.id" 
                              :class="{
                              [`bg-[${item.color}]`]: true,
                              'border-white': item.color != backColorSelected.color,
                              'border-black border-2': item.color == backColorSelected.color 
                              }"
                              class="w-8 h-8 cursor-pointer rounded-full flex justify-center items-center"
                              @click="handlerChangeMaterial('1_2', item)"
                           >
                              <svg v-if="item.color == backColorSelected.color" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                              </svg>
                           </div>
                        </div>
                     </div>
                     <div class="mb-5 grid grid-cols-[120px_1fr] items-center gap-6">
                        <div class="text-xl">Bordes</div>
                        <div class="flex flex-wrap gap-3">
                           <div
                              v-for="item in colors.side"
                              :key="item.id" 
                              :class="{
                              [`bg-[${item.color}]`]: true,
                              'border-white': item.color != borderColorSelected.color,
                              'border-black border-2': item.color == borderColorSelected.color 
                              }"
                              class="w-8 h-8 cursor-pointer rounded-full flex justify-center items-center"
                              @click="handlerChangeMaterial('1_1', item)"
                           >
                              <svg v-if="item.color == borderColorSelected.color" class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                              </svg>
                           </div>
                        </div>
                     </div>
                     <div class="mb-5 grid grid-cols-[120px_1fr] items-center gap-6">
                        <div class="text-xl">Texto</div>
                        <div class="flex flex-wrap gap-3">
                           <input v-model="text" @input="handlerInput" class="bg-gray-50 border w-full md:w-1/3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " />
                        </div>
                     </div>
                     <div class="mb-5 grid grid-cols-[120px_1fr] items-center gap-6">
                        <div class="text-xl">Tamaño</div>
                        <div class="flex flex-wrap gap-3">
                           <div
                              v-for="item in [20, 25, 30]"
                              :key="item" 
                              :class="{
                                 'bg-red-400 text-white': item === textSize
                              }"
                              class="cursor-pointer rounded-xl px-2 py-1 flex justify-center items-center bg-gray-300"
                              @click="handlerChangeSize(item)"
                           >
                              {{fontSize[item]}}
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mb-8">
                     <div><b>Modelo:</b> {{ model }}</div>
                     <div><b>Color parte trasera:</b> {{ backColorSelected.color }} ({{ backColorSelected.id }})</div>
                     <div><b>Color border:</b> {{ borderColorSelected.color }} ({{ borderColorSelected.id }})</div>
                     <div><b>Texto:</b> {{ text }}</div>
                     <div><b>Tamaño:</b> {{ fontSize[textSize] }}</div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                     <div class="border w-full h-[500px] rounded-md p-5 flex justify-center items-center">
                        <div :class="{
                           [`border-[${borderColorSelected.color}]`]: true,
                           [`bg-[${backColorSelected.color}]`]: true,
                           }" 
                           class="md:w-[43%] h-full rounded-xl grid grid-rows-[30%_1fr] grid-cols-1 p-1 border-8"
                        >
                           <div class="flex justify-center">
                              <div class="w-4 h-4 mt-3 rounded-full bg-black border-2 border-white"></div>
                           </div>
                           <div class="w-full rounded -pb-4" ref="container">
                              <v-stage
                                 ref="stage"
                                 :config="stageSize"
                                 @mousedown="handlerStageMouseDown"
                                 @touchstart="handlerStageMouseDown"
                              >
                                 <v-layer ref="layer">
                                    <v-line
                                       :config="lineUpConfig" 
                                    />
                                    <v-text
                                       ref="textObj"
                                       :config="textConfig"
                                       @dragend="handlerDragEnd"
                                       @transformend="handlerTransformEnd"
                                    />
                                    <v-transformer 
                                       :centeredScaling="true"
                                       :rotationSnaps="[0, 90, 180, 270]"
                                       :resizeEnabled="false"
                                       :flipEnabled="false"
                                       :boundBoxFunc="boundBoxFunc"
                                       ref="transformer"
                                       @dragmove="handlerTransformMoved"
                                    />
                                 </v-layer>
                              </v-stage>
                           </div>
                        </div>
                     </div>
                     <div class="mb-8" data-html2canvas-ignore="true">
                        <div class="border w-full h-[500px] rounded-md">
                           <TresCanvas clear-color="#fff" preset="realistic">
                              <TresPerspectiveCamera :position="[3, 2, -250]" />
                              <OrbitControls />
                              <Suspense>
                                 <primitive :object="scene" />
                              </Suspense>
                              <TresDirectionalLight :intensity="2" :position="[3, 3, 3]" />
                              <TresAmbientLight :intensity="1" />
                           </TresCanvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
   </div>
</div>
</template>
 <script setup>
   import { ref, onMounted, toRaw, computed } from "vue";
   import * as THREE from "three";
   import { TresCanvas } from "@tresjs/core";
   import { useGLTF, OrbitControls } from "@tresjs/cientos";
   import html2canvas from 'html2canvas';
   
   const colors = {
      side: [
            {id: 1, color: '#057EB5'},
            {id: 2, color: '#00138D'},
            {id: 3, color: '#8A0156'},
            {id: 4, color: '#EB6B2B'},
            {id: 5, color: '#232325'},
            {id: 6, color: '#8A33EE'},
            {id: 7, color: '#FA1432'},
            {id: 8, color: '#305E9B'},
      ],
      back: [
            {id: 1, color: '#83BE01'},
            {id: 2, color: '#DEB229'},
            {id: 3, color: '#A8A8A8'},
            {id: 4, color: '#F0F0F2'},
            {id: 5, color: '#7DFC01'},
            {id: 6, color: '#FFFD03'},
            {id: 7, color: '#FEC708'},
            {id: 8, color: '#563E3B'},
      ]
   };
   
   const fontSize = {
      20: "Normal",
      25: "Mediano",
      30: "Grande"
   };

   const backColorSelected = ref(colors.back[0]);
   const borderColorSelected = ref(colors.side[0]);
   const model = ref(window.model);
   const text = ref('');
   const textSize = ref(20);
   const page = ref();
   const modePrint = ref(false);
    
   const scene = new THREE.Scene();
   const pieces = ref([]);

   const container = ref();
   const stageSize = ref({});
   const stage = ref();
   const layer = ref();
   const textObj = ref();
   const transformer = ref();
   const textConfig = ref({
      text: "",
      fontSize: 20,
      x: 0,
      y: 0,
      draggable: true,
      name: "text",
      fill: 'black'
   });
   let selectedShapeName = "";

   const codeCover = computed(() => 
      `${window.model}_back_${backColorSelected.value.id}_${backColorSelected.value.color.replace('#', '')}_side_${borderColorSelected.value.id}_${borderColorSelected.value.color.replace('#', '')}_text_${text.value}_fontSize_${textSize.value}`)
    
   function handlerChangeMaterial(piece, item) {
      scene.remove(scene.children[0]);
      const group = new THREE.Group();
      
      if(piece == '1_1') {
         borderColorSelected.value = item;
      } else if(piece == '1_2') {
         backColorSelected.value = item;
      }
      
      const pieceSelected = pieces.value.filter((x) => x.key === piece)[0];
      const pieceToChange = toRaw(pieceSelected.value);
      let mat = toRaw(pieceSelected.material);
      mat.color.set(item.color)
      pieceToChange.material = mat;
      group.add(pieceToChange);
      
      for (const iterator of pieces.value) {
         if (iterator.key !== piece) {
            group.add(toRaw(iterator.value));
         }
      }
      
      scene.add(group);
   }

   function handlerChangeSize (size) {
      textSize.value = size;
      textConfig.value.fontSize = size;
   }
   
   function handlerInput (e) {
      if (text.value.length > 40) {
         text.value = text.value.slice(0, 40);
      } else {
         textConfig.value.text = e.target.value;
      }
   }

   function boundBoxFunc (oldBox, newBox) {
      const stageV = stage.value.getStage();
      const box = getClientRect(newBox);
      const isOut =
            box.x < 0 ||
            box.y < 0 ||
            box.x + box.width > stageV.width() ||
            box.y + box.height > stageV.height();

      if (isOut) {
            return oldBox;
      }
      return newBox;
   }

   function getCorner (pivotX, pivotY, diffX, diffY, angle) {
      const distance = Math.sqrt(diffX * diffX + diffY * diffY);

      /// find angle from pivot to corner
      angle += Math.atan2(diffY, diffX);

      /// get new x and y and round it off to integer
      const x = pivotX + distance * Math.cos(angle);
      const y = pivotY + distance * Math.sin(angle);

      return { x: x, y: y };
   }

   function getClientRect (rotatedBox) {
      const { x, y, width, height } = rotatedBox;
      const rad = rotatedBox.rotation;

      const p1 = getCorner(x, y, 0, 0, rad);
      const p2 = getCorner(x, y, width, 0, rad);
      const p3 = getCorner(x, y, width, height, rad);
      const p4 = getCorner(x, y, 0, height, rad);

      const minX = Math.min(p1.x, p2.x, p3.x, p4.x);
      const minY = Math.min(p1.y, p2.y, p3.y, p4.y);
      const maxX = Math.max(p1.x, p2.x, p3.x, p4.x);
      const maxY = Math.max(p1.y, p2.y, p3.y, p4.y);

      return {
            x: minX,
            y: minY,
            width: maxX - minX,
            height: maxY - minY,
      }
   }

   function getTotalBox (boxes) {
      let minX = Infinity;
      let minY = Infinity;
      let maxX = -Infinity;
      let maxY = -Infinity;

      boxes.forEach((box) => {
            minX = Math.min(minX, box.x);
            minY = Math.min(minY, box.y);
            maxX = Math.max(maxX, box.x + box.width);
            maxY = Math.max(maxY, box.y + box.height);
      });
      return {
            x: minX,
            y: minY,
            width: maxX - minX,
            height: maxY - minY,
      };
   }

   function handlerTransformEnd (e) {
      textConfig.value.x = e.target.x();
      textConfig.value.y = e.target.y();
      textConfig.value.rotation = e.target.rotation();
      textConfig.value.scaleX = e.target.scaleX();
      textConfig.value.scaleY = e.target.scaleY();
   }

   function handlerTransformMoved (e) {
      const transformerNode = transformer.value.getNode();
      const stage = transformerNode.getStage();
      const boxes = transformerNode.nodes().map((node) => node.getClientRect());
      const box = getTotalBox(boxes);
      transformerNode.nodes().forEach((shape) => {
         const absPos = shape.getAbsolutePosition();
         // where are shapes inside bounding box of all shapes?
         const offsetX = box.x - absPos.x;
         const offsetY = box.y - absPos.y;

         // we total box goes outside of viewport, we need to move absolute position of shape
         const newAbsPos = { ...absPos };
         if (box.x < 0) {
            newAbsPos.x = -offsetX;
         }
         if (box.y < 0) {
            newAbsPos.y = -offsetY;
         }
         if (box.x + box.width > stage.width()) {
            newAbsPos.x = stage.width() - box.width - offsetX;
         }
         if (box.y + box.height > stage.height()) {
            newAbsPos.y = stage.height() - box.height - offsetY;
         }
         shape.setAbsolutePosition(newAbsPos);
      });
   }

   function handlerStageMouseDown (e) {
      if (e.target === e.target.getStage()) {
         selectedShapeName = "";
         updateTransformer();
         return;
      }

      const clickedOnTransformer = e.target.getParent().className === "Transformer";
      if (clickedOnTransformer) {
            return;
      }

      const name = e.target.name();
      selectedShapeName = name;
      updateTransformer();
   }

   function handlerDragEnd (e) {
      const textNode = e.target;
      var distanciaIzquierda = textNode.x();
      var distanciaDerecha = stageSize.value.width - (textNode.x() + textNode.width());
      var distanciaArriba = textNode.y();
      var distanciaAbajo = stageSize.value.height - (textNode.y() + textNode.height());
      console.log(distanciaIzquierda, distanciaDerecha, distanciaArriba, distanciaAbajo);
   }

   function updateTransformer () {
      const transformerNode = transformer.value.getNode();
      const stage = transformerNode.getStage();
      const selectedNode = stage.findOne("." + selectedShapeName);
      if (selectedNode === transformerNode.node()) {
            return;
      }
      if (selectedNode) {
         transformerNode.nodes([selectedNode]);
         const boxes = transformerNode.nodes().map((node) => node.getClientRect());
         const box = getTotalBox(boxes);
         transformerNode.nodes().forEach((shape) => {
            const absPos = shape.getAbsolutePosition();
            const offsetX = box.x - absPos.x;
            const offsetY = box.y - absPos.y;

            const newAbsPos = { ...absPos };
            if (box.x < 0) {
               newAbsPos.x = -offsetX;
            }
            if (box.y < 0) {
               newAbsPos.y = -offsetY;
            }
            if (box.x + box.width > stage.width()) {
               newAbsPos.x = stage.width() - box.width - offsetX;
            }
            if (box.y + box.height > stage.height()) {
               newAbsPos.y = stage.height() - box.height - offsetY;
            }
            shape.setAbsolutePosition(newAbsPos);
         });
      } else {
         transformerNode.nodes([]);
      }
   }

   async function handlerFinish() {
      modePrint.value = true;
      html2canvas(page.value).then(function(canvas) {
         canvas.toBlob(function(blob) {
            const filename = `${codeCover.value}.png`
            const formData = new FormData();
            formData.append('image', blob, filename);
            formData.append('filename', filename);

            fetch('/api/upload', {
               method: 'POST',
               body: formData
            }).then(function(response) {
               if (response.ok) {
                  alert('Imagen subida con éxito');
               } else {
                  alert('Error al subir la imagen:', response.statusText);
               }
            }).catch(function(error) {
               console.error('Error de red:', error);
            });
            modePrint.value = false;
         }, 'image/png');
      });
   }
    
   async function init3d() {
      try {
         const { nodes, materials } = await useGLTF(window.urlGlb, {
            draco: true,
         });
      
         pieces.value = Object.entries(nodes)
            .filter(([key]) => key.includes("_"))
            .map(([key, value]) => ({ key, value }));
      
         for (const key in materials) {
            const partes = key.split("_");
            const id = partes.slice(0, -1).join("_");
            const p = pieces.value.find((x) => x.key == id);
            if (p) {
            p.material = materials[key];
            }
         }
      
         scene.remove(scene.children[0]);
         
         const group = new THREE.Group();
      
         for (const iterator of pieces.value) {
            const piece = toRaw(iterator.value);
            let mat = toRaw(piece.material);
            if(iterator.key == '1_2')
               mat.color.set(backColorSelected.color);
            if(iterator.key == '1_1')
               mat.color.set(borderColorSelected.color);
            piece.material = mat;
            group.add(piece);
         }
      
         scene.add(group);
      } catch (error) {
         console.log("No se ha podido cargar el glb " + window.pathGlb + error);
      }
   }

   function init2d() {
      stageSize.value = { width: container.value.clientWidth, height: container.value.clientHeight };
      const anchoCelda = stageSize.value.width / 6;
      const altoCelda = stageSize.value.height / 6;
      const numColumnas = 6;
      const numFilas = 6;

      for (var i = 0; i <= numColumnas; i++) {
         var x = i * anchoCelda;
         var lineaVertical = new Konva.Line({
            points: [x, 0, x, stageSize.value.height],
            stroke: 'rgba(0, 0, 0, 0.2)',
            strokeWidth: 1
         });
         layer.value.getNode().add(lineaVertical);
      }

      for (var j = 0; j <= numFilas; j++) {
         var y = j * altoCelda;
         var lineaHorizontal = new Konva.Line({
            points: [0, y, stageSize.value.width, y],
            stroke: 'rgba(0, 0, 0, 0.2)',
            strokeWidth: 1
         });
         layer.value.getNode().add(lineaHorizontal);
      }
   }
    
   onMounted(async () => {
      init2d();
      init3d();
   });
 </script>