import './bootstrap';

import React, { Suspense, lazy } from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import { createRoot } from 'react-dom/client';
// import PageLoader from './components/loaders/PageLoader';

const Home = lazy(() => import("./pages/home"));
const PageLoader = lazy(() => import("./components/loaders/PageLoader"));


export default function App(){
    return(
        <React.StrictMode>
            <Router>
                <Suspense fallback={<PageLoader/>}>
                    <Routes>
                        <Route path='/' element={<Home/>}></Route>

                    </Routes>
                </Suspense>
            </Router>
        </React.StrictMode>
    );

}

if(document.getElementById('app')){
    createRoot(document.getElementById('app')).render(<App />)
}
