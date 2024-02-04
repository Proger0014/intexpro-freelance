import { HomeLayout } from "../../layouts";
import HomeBanner from "./HomeBanner";
import HomeMain from "./HomeMain";
import c from "./home.module.scss";

const ROUTE = "/";

function HomePage() {
  return (
    <HomeLayout
      banner={<HomeBanner w="50%" pb="30%" />}
      main={<HomeMain pt="60px" className={c.home} />} />
  )
}

export { ROUTE };

export default HomePage;